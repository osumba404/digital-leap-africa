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
        $user = Auth::user();
        $enrollment = \App\Models\Enrollment::where('user_id', $user->id)->where('course_id', $course->id)->first();
        if (!$enrollment) {
            return redirect()->route('courses.show', $course)->with('error', 'You must be enrolled to view this lesson.');
        }

        // Check sequential access: previous lesson must be fully completed (including its test if any)
        $topic = $lesson->topic;
        $topicLessons = $topic->lessons()->orderBy('order')->orderBy('created_at')->get();
        $currentLessonIndex = $topicLessons->search(fn ($item) => $item->id === $lesson->id);

        if ($currentLessonIndex > 0) {
            $previousLesson = $topicLessons[$currentLessonIndex - 1];
            if (!$enrollment->hasCompletedLesson($previousLesson)) {
                $msg = "Please complete '{$previousLesson->title}'";
                $prevExam = \App\Models\Exam::where('lesson_id', $previousLesson->id)->where('type', 'post_lesson')->where('is_enabled', true)->first();
                if ($prevExam) {
                    $msg .= ' and pass its lesson test';
                }
                $msg .= ' before accessing this lesson.';
                return redirect()->route('courses.show', $course)->with('error', $msg);
            }
        }

        // If not first lesson in course, check all previous topics' lessons are fully completed
        $course->load(['topics' => fn ($q) => $q->orderBy('order')->with(['lessons' => fn ($q) => $q->orderBy('order')])]);
        $currentTopicIndex = $course->topics->search(fn ($t) => $t->id === $topic->id);
        if ($currentTopicIndex > 0) {
            $previousTopics = $course->topics->slice(0, $currentTopicIndex);
            foreach ($previousTopics as $prevTopic) {
                foreach ($prevTopic->lessons as $prevLesson) {
                    if (!$enrollment->hasCompletedLesson($prevLesson)) {
                        $msg = "Please complete '{$prevLesson->title}'";
                        $prevExam = \App\Models\Exam::where('lesson_id', $prevLesson->id)->where('type', 'post_lesson')->where('is_enabled', true)->first();
                        if ($prevExam) {
                            $msg .= ' and pass its lesson test';
                        }
                        $msg .= ' before accessing this lesson.';
                        return redirect()->route('courses.show', $course)->with('error', $msg);
                    }
                }
            }
        }

        return view('pages.lessons.show', compact('lesson', 'course', 'enrollment'));
    }

    /**
     * NEW: Handle marking a lesson as complete.
     * If the lesson has an enabled post-lesson test, the user must have completed it first.
     */
    public function complete(Request $request, Lesson $lesson)
    {
        $user = Auth::user();
        $course = $lesson->topic->course;
        $enrollment = \App\Models\Enrollment::where('user_id', $user->id)->where('course_id', $course->id)->first();

        if (!$enrollment) {
            return redirect()->route('courses.show', $course)->with('error', 'You must be enrolled to mark lessons complete.');
        }

        // If this lesson has a post-lesson test, require it to be completed first
        $lessonExam = \App\Models\Exam::where('lesson_id', $lesson->id)
            ->where('type', \App\Models\Exam::TYPE_POST_LESSON)
            ->where('is_enabled', true)
            ->first();
        if ($lessonExam) {
            $completedAttempt = \App\Models\ExamAttempt::where('exam_id', $lessonExam->id)
                ->where('enrollment_id', $enrollment->id)
                ->where('status', \App\Models\ExamAttempt::STATUS_COMPLETED)
                ->exists();
            if (!$completedAttempt) {
                return redirect()->back()->with('error', 'Please complete the lesson test before marking this lesson as complete.');
            }
        }

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