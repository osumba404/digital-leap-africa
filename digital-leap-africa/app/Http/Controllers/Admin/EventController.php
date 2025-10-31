<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest('date')->paginate(20);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request);

        // Handle image from Cropper (base64) or file upload
        $imageUrl = $this->saveImageFromRequest($request);

        $event = Event::create(array_merge($data, [
            'image_path' => $imageUrl,
        ]));

        // Notify all users about new upcoming event
        $eventDate = Carbon::parse($event->date);
        if ($eventDate->isFuture()) {
            $users = User::all();
            foreach ($users as $user) {
                Notification::createNotification(
                    $user->id,
                    'new_event',
                    'New Event: ' . $event->title,
                    "Join us on {$eventDate->format('M d, Y')} at {$event->location}",
                    route('events.show', $event->id)
                );
            }
        }

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event created.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $this->validateRequest($request);

        // If user provided new image (via crop or file), replace existing
        $newImageUrl = $this->saveImageFromRequest($request, $event->image_path);

        if ($newImageUrl !== null) {
            $data['image_path'] = $newImageUrl;
        }

        $event->update($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        // Delete attached image if exists
        if (!empty($event->image_path)) {
            $this->deleteStoredUrl($event->image_path);
        }
        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event deleted.');
    }

    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:255'],
            'topic' => ['nullable', 'string', 'max:120'],
            'date' => ['required', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:date'],
            'description' => ['nullable', 'string'],
            'registration_url' => ['nullable', 'url'],
            // Image inputs (both optional; one may be provided by the client)
            'image_file' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
            'image_cropped_data' => ['nullable', 'string'],
        ]);
    }

    // Returns a public URL (Storage::url) or null if none provided
    private function saveImageFromRequest(Request $request, ?string $existingUrl = null): ?string
    {
        $savedUrl = null;

        // Priority 1: cropped base64 data from Cropper.js
        if ($request->filled('image_cropped_data')) {
            $dataUrl = $request->input('image_cropped_data');
            if (preg_match('/^data:image\\/(png|jpg|jpeg|webp);base64,/', $dataUrl, $m)) {
                $extension = $m[1] === 'jpg' ? 'jpeg' : $m[1];
                $data = base64_decode(substr($dataUrl, strpos($dataUrl, ',') + 1));

                $path = 'public/events/' . uniqid('event_') . '.' . $extension;
                Storage::put($path, $data);
                $savedUrl = Storage::url($path);
            }
        }
        // Priority 2: raw file upload
        elseif ($request->hasFile('image_file')) {
            $stored = $request->file('image_file')->store('public/events');
            $savedUrl = Storage::url($stored);
        }

        // If we saved a new image and had an old one, delete the old file
        if ($savedUrl && $existingUrl) {
            $this->deleteStoredUrl($existingUrl);
        }

        return $savedUrl;
    }

    // Helper to delete a public URL that was created via Storage::url
    private function deleteStoredUrl(string $publicUrl): void
    {
        // Convert '/storage/foo/bar.jpg' to 'public/foo/bar.jpg'
        $storagePath = preg_replace('#^/storage/#', 'public/', $publicUrl);
        if ($storagePath) {
            Storage::delete($storagePath);
        }
    }
}