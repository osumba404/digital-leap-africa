<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PointRule;

class PointRulesSeeder extends Seeder
{
    public function run(): void
    {
        $rules = [
            [
                'name' => 'Lesson Completion',
                'action' => 'lesson_complete',
                'points' => 50,
                'description' => 'Points awarded for completing a lesson',
                'active' => true
            ],
            [
                'name' => 'Course Completion',
                'action' => 'course_complete',
                'points' => 200,
                'description' => 'Points awarded for completing an entire course',
                'active' => true
            ],
            [
                'name' => 'Course Enrollment',
                'action' => 'course_enroll',
                'points' => 20,
                'description' => 'Points awarded for enrolling in a course',
                'active' => true
            ],
            [
                'name' => 'Forum Post',
                'action' => 'forum_post',
                'points' => 10,
                'description' => 'Points awarded for creating a forum post',
                'active' => true
            ],
            [
                'name' => 'Forum Reply',
                'action' => 'forum_reply',
                'points' => 5,
                'description' => 'Points awarded for replying to a forum post',
                'active' => true
            ],
            [
                'name' => 'Daily Login',
                'action' => 'daily_login',
                'points' => 5,
                'description' => 'Points awarded for daily login',
                'active' => true
            ]
        ];

        foreach ($rules as $rule) {
            PointRule::updateOrCreate(
                ['action' => $rule['action']],
                $rule
            );
        }
    }
}