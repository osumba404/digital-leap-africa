<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ELibraryResource;
use Illuminate\Support\Str;

class ELibraryResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ELibraryResource::create([
            'title' => 'The Official Laravel Documentation',
            'slug' => Str::slug('The Official Laravel Documentation'),
            'description' => 'A comprehensive guide to the Laravel framework, covering everything from basics to advanced features. The perfect starting point for any new developer.',
            'type' => 'eBook',
            'file_url' => 'https://laravel.com/docs/10.x',
            'image_url' => 'https://via.placeholder.com/640x480.png/020b13/ffffff?text=Laravel+eBook',
        ]);

        ELibraryResource::create([
            'title' => 'Introduction to Vue.js 3',
            'slug' => Str::slug('Introduction to Vuejs 3'),
            'description' => 'A video tutorial series from Laracasts that walks through the fundamentals of building reactive user interfaces with Vue.js.',
            'type' => 'Video',
            'file_url' => 'https://laracasts.com/series/learn-vue-3-step-by-step',
            'image_url' => 'https://via.placeholder.com/640x480.png/020b13/ffffff?text=Vue.js+Video',
        ]);
    }
}