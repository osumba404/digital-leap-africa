<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'lesson_id',
        'type',
        'title',
        'description',
        'is_enabled',
        'time_limit_minutes',
        'count_towards_final_grade',
        'order',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'count_towards_final_grade' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Exam $exam) {
            if ($exam->type === self::TYPE_PRE_COURSE) {
                $exam->count_towards_final_grade = false;
            }
        });
    }

    public const TYPE_PRE_COURSE = 'pre_course';
    public const TYPE_POST_LESSON = 'post_lesson';
    public const TYPE_FINAL = 'final';

    public const QUESTION_TYPE_SINGLE_CHOICE = 'single_choice';
    public const QUESTION_TYPE_MULTIPLE_CHOICE = 'multiple_choice';
    public const QUESTION_TYPE_TEXT = 'text';

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class)->orderBy('order');
    }

    public function attempts()
    {
        return $this->hasMany(ExamAttempt::class);
    }

    /**
     * Total possible points for this exam.
     */
    public function getTotalPointsAttribute(): float
    {
        return $this->questions->sum('points');
    }

    /**
     * Check if this exam counts toward final grade (lesson tests + final exam).
     */
    public function countsTowardFinalGrade(): bool
    {
        return $this->count_towards_final_grade;
    }
}
