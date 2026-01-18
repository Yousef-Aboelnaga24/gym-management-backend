<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Trainer,
    Category,
    Member,
    Plan,
    Membership,
    Session,
    Booking
};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Trainer::factory(5)->create();
        Category::factory(7)->create();
        Member::factory(20)->create();
        Plan::factory(5)->create();
        Membership::factory(10)->create();

        $sessions = Session::factory(10)->create();

        foreach ($sessions as $session) {
            $members = Member::inRandomOrder()
                ->take(rand(1, $session->capacity))
                ->get();

            foreach ($members as $member) {
                Booking::create([
                    'member_id' => $member->id,
                    'session_id' => $session->id,
                    'booking_date' => now(),
                    'is_attended' => rand(0, 1),
                ]);
            }
        }
    }
}