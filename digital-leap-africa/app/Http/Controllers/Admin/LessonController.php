<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    // Display a list of the lessons for a specific topic.
    public function index(Topic $topic)
    {
        return view('admin.lessons.index', [
            'topic' => $topic,
            'lesson' => new Lesson() // For the create form
        ]);
    }

    // Store a newly created lesson in storage.
    public function store(Request $request, Topic $topic)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:note,video,assignment,quiz',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'resource_url' => 'nullable|url',
        ]);

        $topic->lessons()->create($validated);

        return redirect()->route('admin.topics.lessons.index', $topic)->with('success', 'Lesson added successfully.');
    }

    // Show the form for editing the specified lesson.
    public function edit(Topic $topic, Lesson $lesson)
    {
        return view('admin.lessons.edit', compact('topic', 'lesson'));
    }

    // Update the specified lesson in storage.
    public function update(Request $request, Topic $topic, Lesson $lesson)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:note,video,assignment,quiz',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'resource_url' => 'nullable|url',
        ]);

        $lesson->update($validated);

        return redirect()->route('admin.topics.lessons.index', $topic)->with('success', 'Lesson updated successfully.');
    }

    // Remove the specified lesson from storage.
    public function destroy(Topic $topic, Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('admin.topics.lessons.index', $topic)->with('success', 'Lesson deleted successfully.');
    }
}