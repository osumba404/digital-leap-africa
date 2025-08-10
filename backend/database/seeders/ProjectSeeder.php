<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::create([
            'title' => 'Community E-learning Platform',
            'description' => 'Contribute to the very platform you are using now! We are looking for frontend and backend developers.',
            'github_url' => 'https://github.com/osumba404/digital-leap-africa',
        ]);

        Project::create([
            'title' => 'USSD Farming Assistant',
            'description' => 'A USSD-based application to help local farmers get information on weather and market prices.',
            'github_url' => null,
        ]);
    }
}