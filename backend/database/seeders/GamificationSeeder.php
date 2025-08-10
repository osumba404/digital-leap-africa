<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Badge;
use App\Models\GamificationPoint;

class GamificationSeeder extends Seeder
{
    public function run(): void
    {
        // Find the admin user
        $user = User::where('email', 'admin@digitalleap.africa')->first();

        if ($user) {
            // Award points for completing a fictional task
            GamificationPoint::create([
                'user_id' => $user->id,
                'points' => 100,
                'action' => 'course_completion',
            ]);

            // Award another set of points
            GamificationPoint::create([
                'user_id' => $user->id,
                'points' => 15,
                'action' => 'forum_post',
            ]);

            // Award a badge
            Badge::create([
                'user_id' => $user->id,
                'badge_type' => 'Pioneer',
                'description' => 'One of the first members of the platform.',
            ]);
        }
    }
}