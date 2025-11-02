<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Notification;
use App\Models\GamificationPoint;
use App\Services\GamificationService;
use App\Services\EmailNotificationService;
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
        $user = Auth::user();

        // Check if already completed
        if ($user->lessons()->where('lesson_id', $lesson->id)->exists()) {
            return redirect()->back()->with('info', 'Lesson already marked as complete.');
        }

        // Attach this lesson to the user's completed lessons list
        $user->lessons()->attach($lesson->id);

        // Award points for lesson completion
        $gamification = new GamificationService();
        $gamification->awardPoints($user, 'lesson_complete', 'Completed lesson: ' . $lesson->title);

        // Get the course
        $course = $lesson->topic->course;

        // Create notification for lesson completion
        Notification::createNotification(
            $user->id,
            'lesson_completed',
            'Lesson Completed!',
            "You've completed: {$lesson->title}",
            route('courses.show', $course->id)
        );

        // Send email notification
        EmailNotificationService::sendNotification('lesson_completed', $user, ['lesson' => $lesson]);

        // Check if user has completed all lessons in the course
        $totalLessons = $course->lessons()->count();
        $completedLessons = $user->lessons()
            ->whereIn('lesson_id', $course->lessons()->pluck('lessons.id'))
            ->count();

        if ($totalLessons > 0 && $completedLessons >= $totalLessons) {
            // User completed the entire course!
            $gamification->awardPoints($user, 'course_complete', 'Completed course: ' . $course->title);

            Notification::createNotification(
                $user->id,
                'course_completed',
                'Course Completed',
                "Congratulations! You've completed {$course->title}",
                route('courses.show', $course->id)
            );

            // Send email notification
            EmailNotificationService::sendNotification('course_completed', $user, ['course' => $course]);

            // Issue certificate if course has certification
            if ($course->has_certification) {
                $certificate = \App\Http\Controllers\CertificateController::issueCertificate($user->id, $course->id);
                if ($certificate) {
                    return redirect()->back()->with('success', 'Congratulations! You completed the course and earned a certificate! <a href="' . route('certificates.show', $certificate) . '" class="text-cyan-400 underline">View Certificate</a>');
                }
            }

            return redirect()->back()->with('success', 'Congratulations! You completed the entire course!');
        }

        // Redirect back to the lesson page with a success message
        return redirect()->back()->with('success', 'Lesson marked as complete!');
    }
}