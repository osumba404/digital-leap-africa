<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $table = 'enrollments';
    
    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'enrolled_at',
        'completed_at',
        'final_grade_percentage',
        'final_grade_points_earned',
        'final_grade_points_possible',
        'final_grade_calculated_at',
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
        'completed_at' => 'datetime',
        'final_grade_calculated_at' => 'datetime',
        'final_grade_percentage' => 'decimal:2',
        'final_grade_points_earned' => 'decimal:2',
        'final_grade_points_possible' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function examAttempts()
    {
        return $this->hasMany(ExamAttempt::class);
    }

    /**
     * True if the user has fully completed this lesson: lesson marked complete AND
     * if the lesson has an enabled post-lesson test, that test has been completed.
     */
    public function hasCompletedLesson(Lesson $lesson): bool
    {
        if (!$this->user->lessons()->where('lesson_id', $lesson->id)->exists()) {
            return false;
        }
        $exam = Exam::where('lesson_id', $lesson->id)
            ->where('type', Exam::TYPE_POST_LESSON)
            ->where('is_enabled', true)
            ->first();
        if (!$exam) {
            return true;
        }
        return ExamAttempt::where('exam_id', $exam->id)
            ->where('enrollment_id', $this->id)
            ->where('status', ExamAttempt::STATUS_COMPLETED)
            ->exists();
    }

    /**
     * True if the user has completed all course work: every lesson in the course
     * is fully completed (including post-lesson test when present).
     */
    public function hasCompletedAllCoursework(): bool
    {
        $course = $this->course;
        if (!$course) {
            $course = Course::find($this->course_id);
        }
        if (!$course) {
            return false;
        }
        $course->load(['topics' => fn ($q) => $q->orderBy('order')->with(['lessons' => fn ($q) => $q->orderBy('order')])]);
        $allLessons = $course->topics->flatMap->lessons;
        foreach ($allLessons as $lesson) {
            if (!$this->hasCompletedLesson($lesson)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Calculate and store final grade from lesson tests + final exam.
     * Pre-course exam does not count toward final grade.
     */
    public function calculateFinalGrade(): void
    {
        $attempts = $this->examAttempts()
            ->with('exam')
            ->where('status', ExamAttempt::STATUS_COMPLETED)
            ->get()
            ->filter(fn ($attempt) => $attempt->exam && $attempt->exam->count_towards_final_grade);

        $totalEarned = $attempts->sum('total_points_earned');
        $totalPossible = $attempts->sum('total_points_possible');
        $percentage = $totalPossible > 0 ? round(($totalEarned / $totalPossible) * 100, 2) : null;

        $this->update([
            'final_grade_points_earned' => $totalEarned,
            'final_grade_points_possible' => $totalPossible,
            'final_grade_percentage' => $percentage,
            'final_grade_calculated_at' => now(),
        ]);
    }
}