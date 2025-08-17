<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('events')->insert([
            [
                'title'       => 'Coding Webinar',
                'description' => 'Learn advanced coding techniques in this interactive webinar.',
                'date'        => '2025-08-01 14:00:00',
                'location'    => 'Zoom',
                'rsvp_url'    => 'https://zoom.us/webinar/coding-101',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'title'       => 'Laravel Hackathon',
                'description' => 'A 48-hour hackathon focused on building Laravel-based projects.',
                'date'        => '2025-09-10 09:00:00',
                'location'    => 'Nairobi Innovation Hub',
                'rsvp_url'    => 'https://eventbrite.com/laravel-hackathon',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
        ]);
    }
}
