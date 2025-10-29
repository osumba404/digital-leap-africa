<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\GamificationPoint;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::query()
            ->where('active', true)
            ->latest()
            ->paginate(9);
        return view('pages.courses.index', ['courses' => $courses]);
    }

    public function show(Course $course): View
    {
        return view('pages.courses.show', ['course' => $course]);
    }

    public function enroll(Request $request, Course $course)
    {
        $user = Auth::user();

        if ($user->courses()->where('course_id', $course->id)->exists()) {
            return redirect()->route('courses.show', $course)->with('error', 'You are already enrolled in this course.');
        }

        $user->courses()->attach($course->id);

        GamificationPoint::create([
            'user_id' => $user->id,
            'points' => 50,
            'reason' => 'Enrolled in course: ' . $course->title,
        ]);

        return redirect()->route('courses.show', $course)->with('success', 'You have successfully enrolled!');
    }
}