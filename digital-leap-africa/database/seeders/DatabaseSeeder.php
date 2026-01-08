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
        $this->call([
            UsersSeeder::class,
            CourseSeeder::class,
            CourseContentSeeder::class,
            ProjectSeeder::class,
            ELibraryResourceSeeder::class,
            JobSeeder::class,
            SiteSettingSeeder::class,
            EventsTableSeeder::class,
            AboutSectionsTableSeeder::class,
            TeamMembersTableSeeder::class,
            PartnersTableSeeder::class,
            ArticlesSeeder::class,
            TestimonialsSeeder::class,
            FaqsSeeder::class,
        ]);
    }
}