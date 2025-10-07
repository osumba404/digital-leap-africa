<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partners = [
            [
                'name' => 'TechAfrica',
                'logo_path' => 'partners/tech-africa.png',
                'website_url' => 'https://techafrica.com',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Digital Skills Initiative',
                'logo_path' => 'partners/digital-skills-initiative.png',
                'website_url' => 'https://digitalskills.org',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Africa Tech Hub',
                'logo_path' => 'partners/africa-tech-hub.png',
                'website_url' => 'https://africatechhub.org',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'eLearning Africa',
                'logo_path' => 'partners/elearning-africa.png',
                'website_url' => 'https://elearning-africa.com',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Innovate Africa',
                'logo_path' => 'partners/innovate-africa.png',
                'website_url' => 'https://innovateafrica.fund',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($partners as $partner) {
            Partner::updateOrCreate(
                ['name' => $partner['name']],
                $partner
            );
        }
    }
}
