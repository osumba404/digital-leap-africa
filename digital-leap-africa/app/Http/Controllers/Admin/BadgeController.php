<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Badge;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BadgeController extends Controller
{
    /**
     * Display a listing of badges.
     */
    public function index()
    {
        $badges = Badge::withCount('users')->latest()->paginate(20);
        return view('admin.badges.index', compact('badges'));
    }

    /**
     * Show the form for creating a new badge.
     */
    public function create()
    {
        return view('admin.badges.create');
    }

    /**
     * Store a newly created badge.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'badge_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'badge_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imgUrl = null;
        if ($request->hasFile('badge_image')) {
            $path = $request->file('badge_image')->store('badges', 'public');
            $imgUrl = Storage::url($path);
        }

        Badge::create([
            'badge_name' => $validated['badge_name'],
            'description' => $validated['description'],
            'img_url' => $imgUrl,
        ]);

        return redirect()->route('admin.badges.index')
            ->with('success', 'Badge created successfully.');
    }

    /**
     * Show the form for editing a badge.
     */
    public function edit(Badge $badge)
    {
        return view('admin.badges.edit', compact('badge'));
    }

    /**
     * Update the specified badge.
     */
    public function update(Request $request, Badge $badge)
    {
        $validated = $request->validate([
            'badge_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'badge_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imgUrl = $badge->img_url;
        if ($request->hasFile('badge_image')) {
            // Delete old image if exists
            if ($badge->img_url) {
                $oldPath = str_replace('/storage/', '', $badge->img_url);
                Storage::disk('public')->delete($oldPath);
            }
            
            $path = $request->file('badge_image')->store('badges', 'public');
            $imgUrl = Storage::url($path);
        }

        $badge->update([
            'badge_name' => $validated['badge_name'],
            'description' => $validated['description'],
            'img_url' => $imgUrl,
        ]);

        return redirect()->route('admin.badges.index')
            ->with('success', 'Badge updated successfully.');
    }

    /**
     * Remove the specified badge.
     */
    public function destroy(Badge $badge)
    {
        // Delete image if exists
        if ($badge->img_url) {
            $path = str_replace('/storage/', '', $badge->img_url);
            Storage::disk('public')->delete($path);
        }

        $badge->delete();

        return redirect()->route('admin.badges.index')
            ->with('success', 'Badge deleted successfully.');
    }

    /**
     * Show form to assign badges to users.
     */
    public function assign(Badge $badge)
    {
        $users = User::orderBy('name')->get();
        $assignedUsers = $badge->users()->pluck('users.id')->toArray();
        
        return view('admin.badges.assign', compact('badge', 'users', 'assignedUsers'));
    }

    /**
     * Store badge assignments to users.
     */
    public function storeAssignment(Request $request, Badge $badge)
    {
        $validated = $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        // Get previously assigned users
        $previousUserIds = $badge->users()->pluck('users.id')->toArray();

        // Sync users with the badge
        $badge->users()->sync($validated['user_ids']);

        // Find newly assigned users (those who weren't assigned before)
        $newUserIds = array_diff($validated['user_ids'], $previousUserIds);

        // Notify newly assigned users
        foreach ($newUserIds as $userId) {
            Notification::createNotification(
                $userId,
                'badge_earned',
                'New Badge Earned',
                "Congratulations! You've earned the {$badge->badge_name} badge",
                route('dashboard') // or route to badges page if you have one
            );
        }

        return redirect()->route('admin.badges.index')
            ->with('success', 'Badge assignments updated successfully.');
    }
}
