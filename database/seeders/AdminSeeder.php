<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@ironpulse.com',
            'password' => Hash::make('admin1234'), // كلمة السر
            'role' => 'admin',
            'phone' => '01000000000',
            'date_of_birth'=>'2000-01-04'
        ]);
    }
}
