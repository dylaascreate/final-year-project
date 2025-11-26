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
            'position' => 'User',
        ]);
        
        $this->call([
            UserSeeder::class,

            // WEBSITE CONTENT MODULE SEEDERS
            // ContentSeeder::class, // seeder for contents
            // NotificationSeeder::class, // seeder for notifications
            // EventSeeder::class, // seeder for events
            // PerksSeeder::class, // seeder for perks

            // SKILLS AND RESOURCES MODULE SEEDERS
            // SkillSeeder::class, // seeder for skills
            // TagSeeder::class, // seeder for tags
            // CourseSeeder::class, // seeder for courses
            // ProjectSeeder::class, // seeder for projects
            
            // CAREER MODULE SEEDERS
            // CareerPathSeeder::class, // seeder for career paths
            // GoalSeeder::class, // seeder for goals
            // NotificationSeeder::class, // seeder for notifications
            // EventSeeder::class, // seeder for events
            
            // AUTHENTICATION AND AUTHORIZATION MODULE SEEDERS
            // ApprovalSeeder::class, // seeder for approvals

            // ROADMAP MODULE SEEDERS
            // RoadmapSeeder::class, // seeder for roadmaps
            // MilestoneSeeder::class, // seeder for milestones
            // ResourceSeeder::class, // seeder for resources

            //PROFILE MODULE SEEDERS
            // MBTISeeder::class, // seeder for MBTI types
            // InterestSeeder::class, // seeder for interests
            // GoalSeeder::class, // seeder for goals
            // OrganizationSeeder::class, // seeder for organizations
        ]);
    }
}
