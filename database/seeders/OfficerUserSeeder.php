<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::firstOrCreate(
            ['email' => 'officer@example.com'],
            [
                'name' => 'Officer Abu',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'role' => \App\Enums\UserRole::Officer,
                'department' => 'Site Visit Unit',
                'is_active' => true,
            ]
        );
    }
}
