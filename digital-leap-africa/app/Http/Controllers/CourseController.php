<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\GamificationPoint;
use App\Models\Notification;
use App\Services\GamificationService;
use App\Services\EmailNotificationService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;

class CourseController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search');
        
        try {
            $query = Course::query()->where('active', true);
        } catch (\Exception $e) {
            $query = Course::query();
        }
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        
        $courses = $query->latest()->paginate(6)->appends(['search' => $search]);
        
        return view('pages.courses.index', compact('courses', 'search'));
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

        if ($course->is_free) {
            // Free Course: Immediate access
            $user->courses()->attach($course->id, [
                'status' => 'active',
                'enrolled_at' => now()
            ]);

            $gamification = new GamificationService();
            $gamification->awardPoints($user, 'course_enroll', 'Enrolled in course: ' . $course->title);

            Notification::createNotification(
                $user->id,
                'course_enrollment',
                'Course Enrollment Successful',
                "You've successfully enrolled in {$course->title}",
                route('courses.show', $course->id)
            );

            // Send email notification
            EmailNotificationService::sendNotification('course_enrollment', $user, ['course' => $course]);

            return redirect()->route('courses.show', $course)->with('success', 'You have successfully enrolled!');
        } else {
            // Premium Course: Pending approval
            $user->courses()->attach($course->id, [
                'status' => 'pending',
                'enrolled_at' => now()
            ]);

            Notification::createNotification(
                $user->id,
                'course_enrollment_pending',
                'Enrollment Pending Approval',
                "Your enrollment in {$course->title} is pending admin approval. You'll be notified once approved.",
                route('courses.show', $course->id)
            );

            // Send email notification for pending enrollment
            EmailNotificationService::sendNotification('generic', $user, [
                'title' => 'Enrollment Pending Approval',
                'message' => "Your enrollment in {$course->title} is pending admin approval. You'll be notified once approved.",
                'url' => route('courses.show', $course->id)
            ]);

            return redirect()->route('courses.show', $course)->with('info', 'Your enrollment is pending admin approval. You will be notified once approved.');
        }
    }
}