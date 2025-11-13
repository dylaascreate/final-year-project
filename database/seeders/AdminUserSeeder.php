<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // User - Student
        User::factory()->create([
            'name' => 'Student',
            'email' => 'student@example.com',
            'password' => Hash::make('test123'),
            'role' => 'user',
            'position' => 'student',
        ]);

        // Admin - Industry
        User::factory()->create([
            'name' => 'Company',
            'email' => 'company@example.com',
            'password' => Hash::make('test123'),
            'role' => 'admin',
            'position' => 'company',
        ]);

        // Admin - Academic Advisor
        User::factory()->create([
            'name' => 'Academic Advisor',
            'email' => 'aa@example.com',
            'password' => Hash::make('test123'),
            'role' => 'admin',
            'position' => 'advisor',
        ]);

        // Admin - Supervisor
        User::factory()->create([
            'name' => 'Supervisor',
            'email' => 'sv@example.com',
            'password' => Hash::make('test123'),
            'role' => 'admin',
            'position' => 'supervisor',
        ]);
        
        // Admin - SuperAdmin
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'sa@example.com',
            'password' => Hash::make('test123'),
            'role' => 'admin',
            'position' => 'superadmin',
        ]);

    }
}
