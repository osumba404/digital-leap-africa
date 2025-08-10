<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::create([
            'title' => 'Introduction to Laravel 10',
            'description' => 'Learn the fundamentals of the Laravel framework, including routing, controllers, and Blade templates.',
            'is_free' => true,
            'instructor_id' => '1',
        ]);

        Course::create([
            'title' => 'Advanced React with Vite',
            'description' => 'Dive deep into React hooks, state management with Context, and building high-performance apps with Vite.',
            'is_free' => false,
            'instructor_id' => '1',
        ]);

        Course::create([
            'title' => 'MySQL for Beginners',
            'description' => 'Understand relational databases, write efficient SQL queries, and manage your data with MySQL.',
            'is_free' => true,
            'instructor_id' => '2',
        ]);
    }
}