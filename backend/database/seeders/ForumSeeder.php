<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\ForumPost;

class ForumSeeder extends Seeder
{
    public function run(): void
    {
        // Create a main topic post
        $mainPost = ForumPost::create([
            'user_id' => 1, // Admin User
            'title' => 'Welcome to the Community Forum!',
            'content' => 'Feel free to ask questions, share ideas, and connect with other learners.',
            'parent_id' => null,
        ]);

        // Create a reply to the main post
        ForumPost::create([
            'user_id' => 1, // Admin User
            'title' => 'Re: Welcome', // Titles for replies are often not shown, but good for data
            'content' => 'This is a great place to start. Looking forward to seeing this community grow!',
            'parent_id' => $mainPost->id,
        ]);
    }
}