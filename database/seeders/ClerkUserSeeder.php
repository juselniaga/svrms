<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClerkUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Clerk User',
            'email' => 'clerk@example.com',
            'password' => bcrypt('password'),
            'role' => \App\Enums\UserRole::Clerk,
        ]);
    }
}
