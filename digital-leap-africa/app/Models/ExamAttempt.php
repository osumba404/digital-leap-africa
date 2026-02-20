<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'user_id',
        'enrollment_id',
        'started_at',
        'completed_at',
        'total_points_earned',
        'total_points_possible',
        'percentage',
        'status',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'total_points_earned' => 'decimal:2',
        'total_points_possible' => 'decimal:2',
        'percentage' => 'decimal:2',
    ];

    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_ABANDONED = 'abandoned';

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function answers()
    {
        return $this->hasMany(ExamAttemptAnswer::class);
    }

    /**
     * Whether this attempt counts toward final grade.
     */
    public function countsTowardFinalGrade(): bool
    {
        return $this->exam && $this->exam->count_towards_final_grade;
    }
}
