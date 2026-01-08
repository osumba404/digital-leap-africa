<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestimonialsSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('role', 'user')->get();
        
        $testimonials = [
            [
                'content' => 'Digital Leap Africa transformed my career! The web development course was comprehensive and practical. I landed my first developer job just 3 months after completing the program.',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'content' => 'The instructors are knowledgeable and supportive. The community aspect of the platform makes learning enjoyable and collaborative. Highly recommended!',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'content' => 'I love how the courses are structured with hands-on projects. The gamification system keeps me motivated to continue learning and earning points.',
                'rating' => 4,
                'is_active' => true,
            ],
            [
                'content' => 'As someone with no prior coding experience, I was nervous about starting. But the beginner-friendly approach and excellent support made all the difference.',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'content' => 'The mobile app development course exceeded my expectations. I built my first app and published it on the app store within 6 months!',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'content' => 'Great platform for continuous learning. The variety of courses and the quality of content keep me coming back for more knowledge.',
                'rating' => 4,
                'is_active' => true,
            ],
            [
                'content' => 'The data science track helped me transition from marketing to analytics. The practical approach and real-world projects were invaluable.',
                'rating' => 5,
                'is_active' => true,
            ],
            [
                'content' => 'Excellent value for money. The courses are well-structured, and the community support is amazing. I\'ve made great connections here.',
                'rating' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $index => $testimonialData) {
            if (isset($users[$index])) {
                $testimonialData['user_id'] = $users[$index]->id;
                
                Testimonial::updateOrCreate(
                    [
                        'user_id' => $testimonialData['user_id'],
                        'content' => $testimonialData['content']
                    ],
                    $testimonialData
                );
            }
        }
    }
}