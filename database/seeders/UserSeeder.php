<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User - Student
        User::factory()->create([
            'name' => 'Student',
            'email' => 'student@example.com',
            'password' => Hash::make('test123'),
            'role' => 'user',
            'position' => 'Student',
        ]);

        // Admin - Industry
        User::factory()->create([
            'name' => 'Company',
            'email' => 'company@example.com',
            'password' => Hash::make('test123'),
            'role' => 'user',
            'position' => 'Company',
        ]);

        // Admin - Academic Advisor
        User::factory()->create([
            'name' => 'Academic Advisor',
            'email' => 'advisor@example.com',
            'password' => Hash::make('test123'),
            'role' => 'educator',
            'position' => 'Advisor',
        ]);

        // Admin - Supervisor
        User::factory()->create([
            'name' => 'Supervisor',
            'email' => 'supervisor@example.com',
            'password' => Hash::make('test123'),
            'role' => 'educator',
            'position' => 'Supervisor',
        ]);
        
        // Admin - SuperAdmin
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('test123'),
            'role' => 'admin',
            'position' => 'Super Admin',
        ]);

    }
}
