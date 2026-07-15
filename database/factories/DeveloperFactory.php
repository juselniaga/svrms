<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Developer>
 */
class DeveloperFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Sdn Bhd',
            'address1' => $this->faker->streetAddress,
            'address2' => $this->faker->secondaryAddress,
            'poskod' => $this->faker->postcode,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'email' => $this->faker->unique()->companyEmail,
            'fax' => $this->faker->phoneNumber,
            'tel' => $this->faker->phoneNumber,
        ];
    }
}
