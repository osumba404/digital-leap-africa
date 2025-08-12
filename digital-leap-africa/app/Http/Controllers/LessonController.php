<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
public function show(Lesson $lesson)
{
// Get the course this lesson belongs to
$course = $lesson->topic->course;

// Eager load relationships to prevent extra queries
$course->load('topics.lessons');

// Check if the authenticated user is enrolled in this course
if (!Auth::user()->courses()->where('course_id', $course->id)->exists()) {
// If not enrolled, redirect them away with an error.
return redirect()->route('courses.show', $course)->with('error', 'You must be enrolled to view this lesson.');
}

return view('pages.lessons.show', compact('lesson', 'course'));
}

/**
* NEW: Handle marking a lesson as complete.
*/
public function complete(Request $request, Lesson $lesson)
{
// Attach this lesson to the user's completed lessons list.
// attach() automatically prevents duplicates, so we don't need to check first.
Auth::user()->lessons()->attach($lesson->id);

// Redirect back to the lesson page with a success message.
return redirect()->back()->with('success', 'Lesson marked as complete!');
}
}