<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
     public function run(): void
    {
        // Call all the seeders you have created
        $this->call([
            SiteSettingsSeeder::class,
            UserSeeder::class,
            GamificationSeeder::class,
            CourseSeeder::class,
            ProjectSeeder::class,
            ELibrarySeeder::class,
            ForumSeeder::class,
        ]);
    }
}