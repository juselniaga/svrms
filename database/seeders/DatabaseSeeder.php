<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Clerk
        User::factory()->create([
            'name' => 'John Clerk',
            'email' => 'clerk@svrms.local',
            'role' => 'Clerk',
            'department' => 'Registration',
        ]);

        // Create Officer
        User::factory()->create([
            'name' => 'Jane Officer',
            'email' => 'officer@svrms.local',
            'role' => 'Officer',
            'department' => 'Site Operations',
        ]);

        // Create Assistant Director
        User::factory()->create([
            'name' => 'Ahmad Penolong Pengarah',
            'email' => 'ad@svrms.local',
            'role' => 'Assistant Director',
            'department' => 'Administration',
        ]);

        // Create Director
        User::factory()->create([
            'name' => 'Datuk Pengarah',
            'email' => 'director@svrms.local',
            'role' => 'Director',
            'department' => 'Management',
        ]);

        // Create Admin
        User::factory()->create([
            'name' => 'System Administrator',
            'email' => 'admin@svrms.local',
            'role' => 'Admin',
            'department' => 'IT Services',
        ]);
    }
}
