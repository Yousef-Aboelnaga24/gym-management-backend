<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $categories = ['Crossfit', 'Yoga', 'Cardio', 'Strength', 'Pilates', 'Zumba', 'HIIT'];

        static $i = 0;
        $name = $categories[$i % count($categories)];
        $i++;

        return [
            'category_name' => $name,
        ];
    }
}