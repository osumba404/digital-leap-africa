<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Course;

class NewCourseNotification extends BaseNotification
{
    public $course;

    public function __construct(User $user, Course $course)
    {
        $this->course = $course;
        
        parent::__construct(
            $user,
            'New Course Available!',
            "We've just launched a new course: '{$course->title}'. Check it out and start learning something new today!",
            route('courses.show', $course->id),
            'Explore Course'
        );
    }
}