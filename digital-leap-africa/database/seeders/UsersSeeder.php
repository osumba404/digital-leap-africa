<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Alice Example',
                'email' => 'alice@example.com',
                'password' => Hash::make('password'), // default password
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bob Example',
                'email' => 'bob@example.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
