<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Lesson;

class LessonCompletionNotification extends BaseNotification
{
    public $lesson;

    public function __construct(User $user, Lesson $lesson)
    {
        $this->lesson = $lesson;
        
        parent::__construct(
            $user,
            'Lesson Completed!',
            "Congratulations! You've completed '{$lesson->title}'. Keep up the great work!",
            route('courses.show', $lesson->topic->course->id),
            'Continue Learning'
        );
    }
}