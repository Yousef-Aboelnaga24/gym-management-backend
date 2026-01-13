<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Basic', 'Standard', 'Premium']),
            'description' => $this->faker->sentence(8),
            'duration_days' => $this->faker->randomElement([30, 60, 90, 180]),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'is_active' => true,
        ];
    }
}
