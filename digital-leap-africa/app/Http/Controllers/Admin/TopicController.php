<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    // Display the list of topics for a specific course
    public function index(Course $course)
    {
        return view('admin.topics.index', compact('course'));
    }

    // Store a new topic for a specific course
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $course->topics()->create($validated);

        return redirect()->route('admin.courses.topics.index', $course)->with('success', 'Topic added successfully.');
    }

    // Delete a topic
    public function destroy(Topic $topic)
    {
        $course = $topic->course; // Get the parent course before deleting
        $topic->delete();
        return redirect()->route('admin.courses.topics.index', $course)->with('success', 'Topic deleted successfully.');
    }
}