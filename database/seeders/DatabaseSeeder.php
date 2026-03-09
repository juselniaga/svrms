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
            'role' => 'clerk',
            'department' => 'Registration',
        ]);

        // Create Officer
        User::factory()->create([
            'name' => 'Jane Officer',
            'email' => 'officer@svrms.local',
            'role' => 'officer',
            'department' => 'Site Operations',
        ]);

        // Create Assistant Director
        User::factory()->create([
            'name' => 'Ahmad Penolong Pengarah',
            'email' => 'ad@svrms.local',
            'role' => 'assistant_director',
            'department' => 'Administration',
        ]);

        // Create Director
        User::factory()->create([
            'name' => 'Datuk Pengarah',
            'email' => 'director@svrms.local',
            'role' => 'director',
            'department' => 'Management',
        ]);
    }
}
