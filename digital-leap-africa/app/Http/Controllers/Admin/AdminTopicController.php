<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminTopicController extends Controller
{
    public function create(Course $course)
    {
        return view('admin.courses.topics.create', compact('course'));
    }

    public function index(Course $course)
    {
        $topics = $course->topics()->orderBy('order')->get();
        return view('admin.courses.topics.index', compact('course', 'topics'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'integer|min:0',
            'is_active' => 'boolean'
        ]);

        $course->topics()->create($validated);

        return redirect()->route('admin.courses.topics.index', $course)
            ->with('success', 'Topic created successfully.');
    }

    public function edit(Course $course, Topic $topic)
    {
        return view('admin.courses.topics.edit', compact('course', 'topic'));
    }

    public function update(Request $request, Course $course, Topic $topic)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'integer|min:0',
            'is_active' => 'boolean'
        ]);

        $topic->update($validated);

        return redirect()->route('admin.courses.topics.index', $course)
            ->with('success', 'Topic updated successfully.');
    }

    public function destroy(Course $course, Topic $topic)
    {
        $topic->delete();
        return back()->with('success', 'Topic deleted successfully.');
    }
}