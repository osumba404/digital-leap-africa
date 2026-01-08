<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teamMembers = [
            [
                'name' => 'John Doe',
                'role' => 'Founder & CEO',
                'bio' => 'John has over 15 years of experience in the tech industry, with a passion for education and digital transformation in Africa.',
                'image_path' => 'team/john-doe.jpg',
                'linkedin_url' => 'https://linkedin.com/in/johndoe',
                'twitter_url' => 'https://twitter.com/johndoe',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Jane Smith',
                'role' => 'Director of Education',
                'bio' => 'Jane is an experienced educator with a background in curriculum development and online learning platforms.',
                'image_path' => 'team/jane-smith.jpg',
                'linkedin_url' => 'https://linkedin.com/in/janesmith',
                'instagram_url' => 'https://instagram.com/janesmith',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Michael Johnson',
                'role' => 'Lead Developer',
                'bio' => 'Michael is a full-stack developer with expertise in building scalable web applications and e-learning platforms.',
                'image_path' => 'team/michael-johnson.jpg',
                'linkedin_url' => 'https://linkedin.com/in/michaeljohnson',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Sarah Williams',
                'role' => 'Community Manager',
                'bio' => 'Sarah is passionate about building and engaging communities around technology and digital skills development.',
                'image_path' => 'team/sarah-williams.jpg',
                'twitter_url' => 'https://twitter.com/sarahwilliams',
                'linkedin_url' => 'https://linkedin.com/in/sarahwilliams',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($teamMembers as $member) {
            TeamMember::updateOrCreate(
                ['email' => strtolower(str_replace(' ', '.', $member['name'])) . '@digitalleapafrica.org'],
                $member
            );
        }
    }
}
