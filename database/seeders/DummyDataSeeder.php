<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create a few developers
        $developers = \App\Models\Developer::factory(5)->create();

        // 2. For each developer, create 2-4 applications
        foreach ($developers as $developer) {
            \App\Models\Application::factory(rand(2, 4))->create([
                'developer_id' => $developer->developer_id,
            ]);
        }
    }
}
