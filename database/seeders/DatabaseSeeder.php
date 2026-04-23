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
            'name' => 'Nadia',
            'email' => 'nadia@mpjasin.gov.my',
            'role' => 'Clerk',
            'department' => 'Registration',
        ]);

        // Create Officer
        User::factory()->create([
            'name' => 'Nazrin',
            'email' => 'nazrin@mpjasin.gov.my',
            'role' => 'Officer',
            'department' => 'Site Operations',
        ]);
         User::factory()->create([
            'name' => 'Khairudin',
            'email' => 'din@mpjasin.gov.my',
            'role' => 'Officer',
            'department' => 'Site Operations',
        ]);

        // Create Assistant Director
        User::factory()->create([
            'name' => 'Asharaf',
            'email' => 'ad@mpjasin.gov.my',
            'role' => 'Assistant Director',
            'department' => 'Administration',
        ]);

        // Create Director
        User::factory()->create([
            'name' => 'Hafidh Bin Sulaiman',
            'email' => 'hafidh@mpjasin.gov.my',
            'role' => 'Director',
            'department' => 'Management',
        ]);

        // Create Admin
        User::factory()->create([
            'name' => 'System Administrator',
            'email' => 'admin@mpjasin.gov.my',
            'role' => 'Admin',
            'department' => 'IT Services',
        ]);
    }
}
