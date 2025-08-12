<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::create([
            'key' => 'logo_url',
            'value' => 'https://via.placeholder.com/150x50.png/020b13/ffffff?text=DLA+Logo',
        ]);
    }
}