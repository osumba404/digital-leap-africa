<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Models\Course;

class LessonController extends Controller
{
    // Display a list of the lessons for a specific topic.
    public function index(Course $course, Topic $topic)
    {
        return view('admin.courses.lessons.index', [
            'topic' => $topic,
            'lesson' => new Lesson() // For the create form
        ]);
    }

    // Handle image upload from Quill editor
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120', // 5MB max
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/lessons/content-images');
            $url = \Illuminate\Support\Facades\Storage::url($path);
            
            return response()->json([
                'success' => true,
                'url' => $url
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No image uploaded'
        ], 400);
    }

    // Store a newly created lesson in storage.
    public function store(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:note,video,assignment,quiz',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'questions' => 'nullable|string',
            'code_snippet' => 'nullable|array',
            'code_snippet.*' => 'nullable|string',
            'resource_files' => 'nullable|array',
            'resource_files.*' => 'nullable|file',
            'attachment_images' => 'nullable|array',
            'attachment_images.*' => 'nullable|image',
        ]);
        
        $data = [
            'title' => $validated['title'],
            'type' => $validated['type'],
            'content' => $validated['content'] ?? null,
            'video_url' => $validated['video_url'] ?? null,
            'questions' => $validated['questions'] ?? null,
            'code_snippet' => collect($request->input('code_snippet', []))
            ->filter(fn ($v) => filled($v))
            ->values()
            ->all(),
        ];
        
        $resourcePaths = [];
        if ($request->hasFile('resource_files')) {
            foreach ($request->file('resource_files') as $file) {
                $path = $file->store('public/lessons/resources');
                $resourcePaths[] = \Illuminate\Support\Facades\Storage::url($path);
            }
        }
      
        $data['resource_url'] = $resourcePaths;
        
        $attachmentPaths = [];
        if ($request->hasFile('attachment_images')) {
            foreach ($request->file('attachment_images') as $file) {
                $path = $file->store('public/lessons/attachments');
                $attachmentPaths[] = \Illuminate\Support\Facades\Storage::url($path);
            }
        }
        $data['attachment_path'] = $attachmentPaths;
       
        // Persist the lesson
        $topic->lessons()->create($data);

        return redirect()->route('admin.topics.lessons.index', [$topic->course, $topic])->with('success', 'Lesson added successfully.');
    }

    // Show the form for editing the specified lesson.
    public function edit(Topic $topic, Lesson $lesson)
    {
        return view('admin.courses.lessons.edit', compact('topic', 'lesson'));
    }

    // Update the specified lesson in storage.
    public function update(Request $request, Topic $topic, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:note,video,assignment,quiz',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'questions' => 'nullable|string',
            'code_snippet' => 'nullable|array',
            'code_snippet.*' => 'nullable|string',
            'resource_files' => 'nullable|array',
            'resource_files.*' => 'nullable|file',
            'attachment_images' => 'nullable|array',
            'attachment_images.*' => 'nullable|image',
        ]);
        
        $data = [
            'title' => $validated['title'],
            'type' => $validated['type'],
            'content' => $validated['content'] ?? null,
            'video_url' => $validated['video_url'] ?? null,
            'questions' => $validated['questions'] ?? null,
            'code_snippet' => collect($request->input('code_snippet', []))
                ->filter(fn ($v) => filled($v))
                ->values()
                ->all(),
        ];
        
        $resourcePaths = [];
        if ($request->hasFile('resource_files')) {
            foreach ($request->file('resource_files') as $file) {
                $path = $file->store('public/lessons/resources');
                $resourcePaths[] = \Illuminate\Support\Facades\Storage::url($path);
            }
        }

        $data['resource_url'] = array_values(array_merge((array)($lesson->resource_url ?? []), $resourcePaths));
        
        $attachmentPaths = [];
        if ($request->hasFile('attachment_images')) {
            foreach ($request->file('attachment_images') as $file) {
                $path = $file->store('public/lessons/attachments');
                $attachmentPaths[] = \Illuminate\Support\Facades\Storage::url($path);
            }
        }
       
        $data['attachment_path'] = array_values(array_merge((array)($lesson->attachment_path ?? []), $attachmentPaths));
        
        // Persist updates
        $lesson->update($data);

        return redirect()->route('admin.topics.lessons.index', [$topic->course, $topic])->with('success', 'Lesson updated successfully.');
    }

    // Remove the specified lesson from storage.
    public function destroy(Topic $topic, Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('admin.topics.lessons.index', [$topic->course, $topic])->with('success', 'Lesson deleted successfully.');
    }

    // Delete a single resource by index from JSON array
    public function destroyResource(Topic $topic, Lesson $lesson, int $index)
    {
        $resources = (array) ($lesson->resource_url ?? []);
        if (array_key_exists($index, $resources)) {
            // Optionally: delete file from storage if it maps to local path
            array_splice($resources, $index, 1);
            $lesson->update(['resource_url' => array_values($resources)]);
        }
        return back()->with('success', 'Resource removed.');
    }

    // Delete a single attachment by index from JSON array
    public function destroyAttachment(Topic $topic, Lesson $lesson, int $index)
    {
        $attachments = (array) ($lesson->attachment_path ?? []);
        if (array_key_exists($index, $attachments)) {
            // Optionally: delete file from storage if it maps to local path
            array_splice($attachments, $index, 1);
            $lesson->update(['attachment_path' => array_values($attachments)]);
        }
        return back()->with('success', 'Attachment removed.');
    }
}