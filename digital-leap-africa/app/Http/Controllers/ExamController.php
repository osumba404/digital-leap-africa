<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\ExamAttemptAnswer;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function show(Exam $exam)
    {
        $user = Auth::user();
        $enrollmentModel = \App\Models\Enrollment::where('user_id', $user->id)->where('course_id', $exam->course_id)->first();

        if (!$enrollmentModel) {
            return redirect()->route('courses.show', $exam->course)->with('error', 'Please confirm your details and start enrollment first.');
        }

        $allowedStatuses = ['active', 'pending_pre_test'];
        if (!in_array($enrollmentModel->status, $allowedStatuses)) {
            return redirect()->route('courses.show', $exam->course)->with('error', 'You must be enrolled to take this test.');
        }

        if ($exam->type === 'pre_course' && $enrollmentModel->status === 'pending_pre_test') {
            $enrollmentModel->load('course');
        }

        if (!$exam->is_enabled) {
            return redirect()->back()->with('error', 'This test is not available.');
        }

        // Final exam: require all lessons and all lesson tests to be completed first
        if ($exam->type === Exam::TYPE_FINAL) {
            if (!$enrollmentModel->hasCompletedAllCoursework()) {
                return redirect()->route('courses.show', $exam->course)
                    ->with('error', 'You must complete all lessons and all lesson tests before taking the final test.');
            }
        }

        $exam->load('questions.options');
        $totalPoints = $exam->questions->sum('points');
        $existingAttempt = ExamAttempt::where('exam_id', $exam->id)
            ->where('user_id', $user->id)
            ->where('enrollment_id', $enrollmentModel->id)
            ->where('status', ExamAttempt::STATUS_COMPLETED)
            ->latest()
            ->first();

        return view('exams.show', compact('exam', 'enrollmentModel', 'totalPoints', 'existingAttempt'));
    }

    public function start(Exam $exam)
    {
        $user = Auth::user();
        $enrollment = \App\Models\Enrollment::where('user_id', $user->id)
            ->where('course_id', $exam->course_id)
            ->whereIn('status', ['active', 'pending_pre_test'])
            ->first();

        if (!$enrollment) {
            return redirect()->route('courses.show', $exam->course)->with('error', 'Please confirm your details and start enrollment first.');
        }

        if (!$exam->is_enabled) {
            return redirect()->back()->with('error', 'This test is not available.');
        }

        // Final exam: require all lessons and all lesson tests to be completed first
        if ($exam->type === Exam::TYPE_FINAL) {
            if (!$enrollment->hasCompletedAllCoursework()) {
                return redirect()->route('courses.show', $exam->course)
                    ->with('error', 'You must complete all lessons and all lesson tests before taking the final test.');
            }
        }

        $exam->load('questions.options');
        if ($exam->questions->isEmpty()) {
            return redirect()->back()->with('error', 'This test has no questions yet.');
        }

        $totalPossible = $exam->questions->sum('points');

        // Mark any existing in-progress attempt as abandoned so they start fresh
        ExamAttempt::where('exam_id', $exam->id)
            ->where('user_id', $user->id)
            ->where('enrollment_id', $enrollment->id)
            ->where('status', ExamAttempt::STATUS_IN_PROGRESS)
            ->update(['status' => ExamAttempt::STATUS_ABANDONED]);

        $attempt = ExamAttempt::create([
            'exam_id' => $exam->id,
            'user_id' => $user->id,
            'enrollment_id' => $enrollment->id,
            'status' => ExamAttempt::STATUS_IN_PROGRESS,
            'total_points_possible' => $totalPossible,
        ]);

        return redirect()->route('exams.take', $attempt);
    }

    public function take(ExamAttempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        if ($attempt->status === ExamAttempt::STATUS_COMPLETED) {
            return redirect()->route('exams.result', $attempt)->with('info', 'You have already completed this test.');
        }

        $attempt->load(['exam.questions' => fn ($q) => $q->orderBy('order')->with('options')]);

        return view('exams.take', compact('attempt'));
    }

    public function submit(Request $request, ExamAttempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        if ($attempt->status === ExamAttempt::STATUS_COMPLETED) {
            return redirect()->route('exams.result', $attempt);
        }

        $attempt->load('exam.questions.options');

        // Require all questions to be attempted before submitting
        foreach ($attempt->exam->questions as $question) {
            if ($question->question_type === 'text') {
                $textAnswer = $request->input("answer_{$question->id}");
                if (!is_string($textAnswer) || trim($textAnswer) === '') {
                    return redirect()->route('exams.take', $attempt)
                        ->with('error', 'Please attempt all questions before submitting.');
                }
            } else {
                $selectedIds = (array) $request->input("answer_{$question->id}", []);
                $selectedIds = array_filter(array_map('intval', $selectedIds));
                if (empty($selectedIds)) {
                    return redirect()->route('exams.take', $attempt)
                        ->with('error', 'Please attempt all questions before submitting.');
                }
            }
        }

        foreach ($attempt->exam->questions as $question) {
            if ($question->question_type === 'text') {
                $textAnswer = $request->input("answer_{$question->id}");
                ExamAttemptAnswer::create([
                    'exam_attempt_id' => $attempt->id,
                    'exam_question_id' => $question->id,
                    'text_answer' => $textAnswer,
                    'points_earned' => 0,
                ]);
            } else {
                $selectedIds = (array) $request->input("answer_{$question->id}", []);
                $selectedIds = array_filter(array_map('intval', $selectedIds));

                $correctIds = $question->options->where('is_correct', true)->pluck('id')->toArray();
                $isCorrect = false;

                if ($question->question_type === 'single_choice') {
                    $isCorrect = count($selectedIds) === 1 && in_array($selectedIds[0], $correctIds);
                } else {
                    $isCorrect = count($selectedIds) === count($correctIds) && empty(array_diff($correctIds, $selectedIds));
                }

                $pointsEarned = $isCorrect ? (float) $question->points : 0;

                ExamAttemptAnswer::create([
                    'exam_attempt_id' => $attempt->id,
                    'exam_question_id' => $question->id,
                    'selected_option_ids' => $selectedIds,
                    'points_earned' => $pointsEarned,
                ]);
            }
        }

        $totalEarned = $attempt->answers()->sum('points_earned');

        $percentage = $attempt->total_points_possible > 0
            ? round(($totalEarned / $attempt->total_points_possible) * 100, 2)
            : null;

        $attempt->update([
            'completed_at' => now(),
            'total_points_earned' => $totalEarned,
            'percentage' => $percentage,
            'status' => ExamAttempt::STATUS_COMPLETED,
        ]);

        $enrollment = $attempt->enrollment;

        if ($attempt->exam->type === 'pre_course' && $enrollment->status === 'pending_pre_test') {
            $enrollment->update(['status' => 'active']);

            $gamification = new \App\Services\GamificationService();
            $gamification->awardPoints(Auth::user(), 'course_enroll', 'Enrolled in course: ' . $enrollment->course->title);

            \App\Models\Notification::createNotification(
                Auth::id(),
                'course_enrollment',
                'Course Enrollment Successful',
                "You've successfully enrolled in {$enrollment->course->title}",
                route('courses.show', $enrollment->course)
            );

            \App\Services\EmailNotificationService::sendNotification('course_enrollment', Auth::user(), ['course' => $enrollment->course]);

            return redirect()->route('courses.show', $enrollment->course)->with('success', 'Pre-course test completed! You are now enrolled in ' . $enrollment->course->title);
        }

        $enrollment->calculateFinalGrade();

        return redirect()->route('exams.result', $attempt)->with('success', 'Test submitted successfully!');
    }

    public function result(ExamAttempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        $attempt->load(['exam.questions.options', 'answers.examQuestion']);

        return view('exams.result', compact('attempt'));
    }

    /**
     * Mark attempt as abandoned when time runs out; redirect to exam start so user can start again.
     */
    public function abandonAttempt(ExamAttempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        if ($attempt->status === ExamAttempt::STATUS_IN_PROGRESS) {
            $attempt->update(['status' => ExamAttempt::STATUS_ABANDONED]);
        }

        return redirect()->route('exams.show', $attempt->exam)
            ->with('error', "Time's up. Please start a new attempt.");
    }
}
