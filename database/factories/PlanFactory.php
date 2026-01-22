<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PlanFactory extends Factory
{
    public function definition(): array
    {
        // اختيارات الفترة
        $periods = ['day', 'week', 'month', 'year'];

        // إنشاء مميزات عشوائية
        $features = [];
        $featureCount = $this->faker->numberBetween(0, 5); // من 0 لـ 5 مميزات
        for ($i = 0; $i < $featureCount; $i++) {
            $features[] = [
                'name' => $this->faker->words(2, true), // نص مكون من كلمتين
                'included' => $this->faker->boolean(),
            ];
        }

        return [
            'name' => $this->faker->unique()->word(), // نص ≤ 100 حرف
            'description' => $this->faker->optional()->sentence(10), // نص ≤ 1000 حرف
            'price' => $this->faker->randomFloat(2, 0, 999999.99),
            'period' => $this->faker->randomElement($periods),
            'duration' => $this->faker->numberBetween(1, 36),
            'features' => $features,
            'popular' => $this->faker->boolean(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
