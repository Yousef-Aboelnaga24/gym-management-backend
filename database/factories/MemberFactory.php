<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state(['role' => 'member'])->has(Address::factory()),
            'photo' => null,
            'height' => $this->faker->numberBetween(150, 250),
            'weight' => $this->faker->numberBetween(50, 120),
            'blood_type' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            'note' => $this->faker->sentence(),
            'join_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
