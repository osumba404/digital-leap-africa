<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::create([
            'title' => 'Introduction to Web Development',
            'slug' => Str::slug('Introduction to Web Development'),
            'description' => 'Learn the fundamentals of HTML, CSS, and JavaScript to build modern websites.',
            'instructor' => 'Collins Otieno',
            'image_url' => 'https://via.placeholder.com/640x480.png/020b13/ffffff?text=Web+Dev',
        ]);

        Course::create([
            'title' => 'Advanced Laravel for Professionals',
            'slug' => Str::slug('Advanced Laravel for Professionals'),
            'description' => 'Dive deep into the Laravel framework and build robust, scalable applications.',
            'instructor' => 'Evans Osumba',
            'image_url' => 'https://via.placeholder.com/640x480.png/020b13/ffffff?text=Laravel',
        ]);

        Course::create([
            'title' => 'Mastering Digital Marketing',
            'slug' => Str::slug('Mastering Digital Marketing'),
            'description' => 'Understand SEO, SEM, and social media strategies to grow online businesses.',
            'instructor' => 'Tony Wangolo',
            'image_url' => 'https://via.placeholder.com/640x480.png/020b13/ffffff?text=Marketing',
        ]);
    }
}