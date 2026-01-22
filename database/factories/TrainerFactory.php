<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state([
                'role' => 'trainer',
            ])->has(Address::factory()),
            'specialties' => $this->faker->randomElement(['Cardio', 'Yoga', 'Fitness','Zomba']),
            'hire_date' => $this->faker->dateTimeBetween('-3 years', 'now'),
        ];
    }
}