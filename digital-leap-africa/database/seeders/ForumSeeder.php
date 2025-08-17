<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ForumSeeder extends Seeder
{
    public function run(): void
    {
        // Sample thread
        $threadId = DB::table('forum_threads')->insertGetId([
            'user_id' => 1, // assuming user with ID 1 exists
            'title' => 'Welcome to the Animal IQ Forum!',
            'content' => 'This is the first thread. Feel free to introduce yourself!',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Sample replies
        DB::table('forum_posts')->insert([
            [
                'thread_id' => $threadId,
                'user_id' => 1,
                'content' => 'Hi everyone! Excited to be here.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'thread_id' => $threadId,
                'user_id' => 2, // another user
                'content' => 'Looking forward to learning more about animals!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
