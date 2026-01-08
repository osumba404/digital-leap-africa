<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@digitalleapafrica.org',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'points' => 1000,
                'level' => 5,
                'bio' => 'System administrator with full access to manage the platform.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'points' => 250,
                'level' => 2,
                'bio' => 'Passionate web developer learning new technologies.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'points' => 180,
                'level' => 2,
                'bio' => 'UI/UX designer interested in front-end development.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Michael Johnson',
                'email' => 'michael.johnson@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'points' => 320,
                'level' => 3,
                'bio' => 'Full-stack developer with 3 years of experience.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Sarah Williams',
                'email' => 'sarah.williams@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'points' => 150,
                'level' => 1,
                'bio' => 'Marketing professional learning digital skills.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'David Brown',
                'email' => 'david.brown@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'points' => 420,
                'level' => 3,
                'bio' => 'Software engineer passionate about mobile development.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily.davis@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'points' => 95,
                'level' => 1,
                'bio' => 'Recent graduate exploring career opportunities in tech.',
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Robert Wilson',
                'email' => 'robert.wilson@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'points' => 280,
                'level' => 2,
                'bio' => 'Data analyst learning machine learning and AI.',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}