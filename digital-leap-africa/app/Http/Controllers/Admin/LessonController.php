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
        return view('admin.courses.lessons.index', [
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
            // new:
            'code_snippet' => 'array',
            'code_snippet.*' => 'string',
            'resource_url' => 'array',
            'resource_url.*' => 'file',
            'attachment_path' => 'array',
            'attachment_path.*' => 'image',
        ]);
        
        $data = [
            'title' => $validated['title'],
            'type' => $validated['type'],
            'content' => $validated['content'] ?? null,
            'video_url' => $validated['video_url'] ?? null,
            'code_snippet' => $validated['code_snippet'] ?? [],
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
        if ($request->hasFile('attachment_path')) {
            foreach ($request->file('attachment_path') as $file) {
                $path = $file->store('public/lessons/attachments');
                $attachmentPaths[] = \Illuminate\Support\Facades\Storage::url($path);
            }
        }
        $data['attachment_paths'] = $attachmentPaths;
        
        // store:
        $topic->lessons()->create($data);

        return redirect()->route('admin.topics.lessons.index', $topic)->with('success', 'Lesson added successfully.');
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
            // new:
            'code_snippet' => 'array',
            'code_snippet.*' => 'string',
            'resource_url' => 'array',
            'resource_url.*' => 'file',
            'attachment_path' => 'array',
            'attachment_path.*' => 'image',
        ]);
        
        $data = [
            'title' => $validated['title'],
            'type' => $validated['type'],
            'content' => $validated['content'] ?? null,
            'video_url' => $validated['video_url'] ?? null,
            'code_snippet' => $validated['code_snippet'] ?? [],
        ];
        
        $resourcePaths = [];
        if ($request->hasFile('resource_url')) {
            foreach ($request->file('resource_url') as $file) {
                $path = $file->store('public/lessons/resources');
                $resourcePaths[] = \Illuminate\Support\Facades\Storage::url($path);
            }
        }
        $data['resource_url'] = array_values(array_merge($lesson->resource_paths ?? [], $resourcePaths));
        
        $attachmentPaths = [];
        if ($request->hasFile('attachment_path')) {
            foreach ($request->file('attachment_path') as $file) {
                $path = $file->store('public/lessons/attachments');
                $attachmentPaths[] = \Illuminate\Support\Facades\Storage::url($path);
            }
        }
        $data['attachment_paths'] = array_values(array_merge($lesson->attachment_paths ?? [], $attachmentPaths));

        
        $lesson->update($data);

        return redirect()->route('admin.topics.lessons.index', $topic)->with('success', 'Lesson updated successfully.');
    }

    // Remove the specified lesson from storage.
    public function destroy(Topic $topic, Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('admin.topics.lessons.index', $topic)->with('success', 'Lesson deleted successfully.');
    }
}