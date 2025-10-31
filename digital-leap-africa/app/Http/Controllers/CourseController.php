<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\GamificationPoint;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(): View
    {
        try {
            $courses = Course::query()
                ->where('active', true)
                ->latest()
                ->paginate(9);
        } catch (\Exception $e) {
            // Fallback if active column doesn't exist
            $courses = Course::query()
                ->latest()
                ->paginate(9);
        }
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

        // Create notification for course enrollment
        Notification::createNotification(
            $user->id,
            'course_enrollment',
            'Course Enrollment Successful',
            "You've successfully enrolled in {$course->title}",
            route('courses.show', $course->id)
        );

        return redirect()->route('courses.show', $course)->with('success', 'You have successfully enrolled!');
    }
}