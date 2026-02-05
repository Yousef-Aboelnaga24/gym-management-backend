<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Session;
use App\Models\Trainer;
use App\Models\Category;

class SessionFactory extends Factory
{
    protected $model = Session::class;

    public function definition(): array
    {
        return [
            'trainer_id' => Trainer::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'name' => $this->faker->sentence(),
            'capacity' => $this->faker->numberBetween(5, 20),
            'start_date' => $this->faker->dateTimeBetween('+1 days', '+10 days'),
            'end_date' => $this->faker->dateTimeBetween('+11 days', '+20 days'),
        ];
    }
}