<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use App\Models\User;                  // Import the User model

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@digitalleap.africa',
            'role' => 'super_admin',
            'password' => Hash::make('password'), // Use a secure password
        ]);
    }
}