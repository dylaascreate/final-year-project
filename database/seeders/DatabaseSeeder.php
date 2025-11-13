<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User - Customer
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('test123'),
            'role' => 'user',
            'position' => 'user',
        ]);
        
        $this->call([
            AdminUserSeeder::class,
            // OrderSeeder::class,
            // ProductSeeder::class,
            // OrderProductSeeder::class,
            // OrderStatusHistorySeeder::class,
        ]);
    }
}
