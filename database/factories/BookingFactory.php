<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Member;
use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Booking::class;
    public function definition(): array
    {
        return [
            'member_id' => Member::factory(),
            'session_id' => Session::factory(),
            'booking_date' => now(),
            'is_attended' => $this->faker->boolean(70),
        ];
    }
}