<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
public function run(): void
    {
        // ... other seeders

        $this->call([
            CourseSeeder::class,
            ProjectSeeder::class,
            ELibraryResourceSeeder::class,
            JobSeeder::class,
            SiteSettingSeeder::class,
        ]);
    }
}