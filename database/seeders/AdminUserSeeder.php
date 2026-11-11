<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Hanane Admin',
            'email' => 'hanane@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create regular user
        User::create([
            'name' => 'Hanane User',
            'email' => 'hanane123@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}