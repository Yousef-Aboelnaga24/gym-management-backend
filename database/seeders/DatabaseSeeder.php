<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Person;
use App\Models\Member;
use App\Models\Trainer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Person::factory()->count(10)->create()->each(function ($person) {

            $address = Address::factory()->create();
            $person->update(['address_id' => $address->id]);

            $type = rand(1, 3);

            if ($type === 1) {
                Member::factory()->create(['person_id' => $person->id]);
            } elseif ($type === 2) {
                Trainer::factory()->create(['person_id' => $person->id]);
            }
            // type === 3 → Person عادي
        });
    }
}
