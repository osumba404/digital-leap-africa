<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::create([
            'title' => 'Community Forum Platform',
            'slug' => Str::slug('Community Forum Platform'),
            'description' => 'A full-featured community forum built with Laravel Livewire to foster real-time discussions and collaboration among DLA members.',
            'github_url' => 'https://github.com/osumba404/digital-leap-africa',
            'image_url' => 'https://via.placeholder.com/640x480.png/020b13/ffffff?text=Forum+Platform',
        ]);

        Project::create([
            'title' => 'E-Learning Gamification Engine',
            'slug' => Str::slug('E-Learning Gamification Engine'),
            'description' => 'Develop a system to award points, badges, and track leaderboards for course completions and community contributions.',
            'github_url' => 'https://github.com/osumba404/digital-leap-africa',
            'image_url' => 'https://via.placeholder.com/640x480.png/020b13/ffffff?text=Gamification',
        ]);
    }
}