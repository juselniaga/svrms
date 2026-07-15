<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = now()->year;
        $statusNumber = $this->faker->numberBetween(1, 100);
        
        // Distribution of statuses for the dashboard
        if ($statusNumber <= 40) {
            $status = 'RECORDED'; // 40%
        } elseif ($statusNumber <= 70) {
            $status = $this->faker->randomElement(['REVIEWING', 'VERIFYING', 'APPROVING', 'SITE_VISIT_IN_PROGRESS']); // 30%
        } elseif ($statusNumber <= 90) {
            $status = 'APPROVED'; // 20%
        } else {
            $status = 'REJECTED'; // 10%
        }

        return [
            'reference_no' => 'SVRMS-' . $year . '-' . $this->faker->unique()->numerify('####'),
            'tajuk' => 'Cadangan Pemajuan ' . $this->faker->words(3, true) . ' di atas Lot ' . $this->faker->numerify('####'),
            'lokasi' => $this->faker->address,
            'no_fail' => 'FAIL/' . $year . '/' . $this->faker->numerify('###'),
            'status' => $status,
            'is_active' => true,
            // To simulate "late" applications, we occasionally set the created_at date to > 14 days ago
            'created_at' => $this->faker->boolean(30) ? now()->subDays($this->faker->numberBetween(15, 30)) : now()->subDays($this->faker->numberBetween(1, 10)),
        ];
    }
}
