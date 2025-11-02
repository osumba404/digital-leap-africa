<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Course;

class CourseApprovalNotification extends BaseNotification
{
    public $course;

    public function __construct(User $user, Course $course, $approved = true)
    {
        $this->course = $course;
        
        if ($approved) {
            parent::__construct(
                $user,
                'Enrollment Approved!',
                "Great news! Your enrollment in {$course->title} has been approved. You can now access all course content.",
                route('courses.show', $course->id),
                'Access Course'
            );
        } else {
            parent::__construct(
                $user,
                'Enrollment Update',
                "Your enrollment in {$course->title} requires further review. Please contact support for more information.",
                route('courses.show', $course->id),
                'View Course'
            );
        }
    }
}