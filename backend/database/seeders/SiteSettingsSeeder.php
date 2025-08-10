<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('site_settings')->insert([
            [
                'key' => 'site_name',
                'value' => 'Digital Leap Africa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'site_description',
                'value' => 'Empowering the next generation of African talent.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'default_language',
                'value' => 'en', // English
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}