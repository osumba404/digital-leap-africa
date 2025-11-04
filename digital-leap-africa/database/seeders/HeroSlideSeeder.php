<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class HeroSlideSeeder extends Seeder
{
    public function run()
    {
        $heroSlides = [
            [
                'enabled' => 1,
                'image' => null,
                'mini' => 'Empowering African Youth',
                'title' => 'Welcome to Digital Leap Africa',
                'sub' => 'Empowering learners across Africa with courses, projects, jobs, events, and a vibrant community.',
                'cta1_label' => 'Browse Courses',
                'cta1_route' => 'courses.index',
                'cta2_label' => 'About Us',
                'cta2_route' => 'about',
            ],
            [
                'enabled' => 1,
                'image' => null,
                'mini' => 'Learn & Grow',
                'title' => 'Master New Skills Today',
                'sub' => 'Join thousands of learners advancing their careers with our expert-led courses and hands-on projects.',
                'cta1_label' => 'View Courses',
                'cta1_route' => 'courses.index',
                'cta2_label' => 'Join Community',
                'cta2_route' => 'forum.index',
            ],
            [
                'enabled' => 1,
                'image' => null,
                'mini' => 'Career Ready',
                'title' => 'Find Your Dream Job',
                'sub' => 'Connect with top employers and discover exciting career opportunities in the tech industry.',
                'cta1_label' => 'Browse Jobs',
                'cta1_route' => 'jobs.index',
                'cta2_label' => 'Build Portfolio',
                'cta2_route' => 'projects.index',
            ]
        ];

        SiteSetting::updateOrCreate(
            ['key' => 'hero_slides'],
            ['value' => json_encode($heroSlides)]
        );

        $this->command->info('Hero slides created successfully!');
    }
}