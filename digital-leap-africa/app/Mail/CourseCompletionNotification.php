<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Course;

class CourseCompletionNotification extends BaseNotification
{
    public $course;

    public function __construct(User $user, Course $course)
    {
        $this->course = $course;
        
        parent::__construct(
            $user,
            'Course Completed! 🎉',
            "Amazing achievement! You've successfully completed '{$course->title}'. You're now ready to apply your new skills!",
            route('courses.show', $course->id),
            'View Certificate'
        );
    }
}