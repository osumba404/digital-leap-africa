<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'question_text',
        'question_type',
        'points',
        'order',
    ];

    protected $casts = [
        'points' => 'decimal:2',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function options()
    {
        return $this->hasMany(ExamQuestionOption::class)->orderBy('order');
    }

    public function attemptAnswers()
    {
        return $this->hasMany(ExamAttemptAnswer::class);
    }

    /**
     * Whether this question has options (single or multiple choice).
     */
    public function hasOptions(): bool
    {
        return in_array($this->question_type, [
            Exam::QUESTION_TYPE_SINGLE_CHOICE,
            Exam::QUESTION_TYPE_MULTIPLE_CHOICE,
        ]);
    }

    /**
     * Whether this is a text/essay question.
     */
    public function isTextQuestion(): bool
    {
        return $this->question_type === Exam::QUESTION_TYPE_TEXT;
    }
}
