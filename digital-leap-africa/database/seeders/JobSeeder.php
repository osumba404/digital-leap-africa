<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        Job::create([
            'title' => 'Junior Laravel Developer',
            'company' => 'Tech Solutions Inc.',
            'location' => 'Nairobi, Kenya',
            'description' => 'We are seeking a motivated Junior Laravel Developer to join our growing team. You will be responsible for building and maintaining web applications for our clients.',
            'application_url' => '#',
        ]);

        Job::create([
            'title' => 'Frontend React Developer',
            'company' => 'Creative Minds Agency',
            'location' => 'Lagos, Nigeria (Remote)',
            'description' => 'Join our remote team to build beautiful, responsive user interfaces for a variety of exciting projects. Strong knowledge of React and modern CSS is required.',
            'application_url' => '#',
        ]);
    }
}