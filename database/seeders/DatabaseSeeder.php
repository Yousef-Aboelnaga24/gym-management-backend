<?php

namespace Database\Seeders;

use App\Models\Address;
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
        Member::factory()->count(10)->create();
        Trainer::factory()->count(5)->create();
    }
}
