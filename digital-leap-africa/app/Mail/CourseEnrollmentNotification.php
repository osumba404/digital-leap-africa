<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Course;

class CourseEnrollmentNotification extends BaseNotification
{
    public $course;

    public function __construct(User $user, Course $course)
    {
        $this->course = $course;
        
        parent::__construct(
            $user,
            'Course Enrollment Successful',
            "You've successfully enrolled in {$course->title}. Start learning now!",
            route('courses.show', $course->id),
            'Start Learning'
        );
    }
}