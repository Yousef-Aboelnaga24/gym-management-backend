<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Plan;
use App\Models\Membership;

use Illuminate\Database\Eloquent\Factories\Factory;

class MembershipFactory extends Factory
{
    protected $model = Membership::class;

    public function definition(): array
    {
        $plan = Plan::inRandomOrder()->first();

        return [
            'member_id' => Member::inRandomOrder()->first()->id,
            'plan_id'   => $plan->id,
            'start_date'=> now(),
            'end_date'  => now()->addDays($plan->duration_days),
            'status'    => 'active',
        ];
    }
}
