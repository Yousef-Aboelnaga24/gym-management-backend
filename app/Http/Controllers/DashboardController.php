<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Trainer;
use App\Models\Booking;
use App\Models\GymClass;
use App\Models\Membership;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function stats()
    {
        $totalMembers = Member::count();
        $activeTrainers = Trainer::count();
        $sessionsToday = GymClass::whereDate('start_date', today())->count();
        $revenue = Membership::with('plan')->get()->sum(fn($m) => $m->plan?->price ?? 0);
        return response()->json([
            'totalMembers' => $totalMembers,
            'activeTrainers' => $activeTrainers,
            'sessionsToday' => $sessionsToday,
            'totalRevenue' => $revenue,
        ]);
    }

    public function membershipDistribution()
    {
        $data = Membership::select('plans.name', DB::raw('count(*) as value'))
            ->join('plans', 'memberships.plan_id', '=', 'plans.id')
            ->groupBy('plans.name')
            ->get();

        return response()->json($data);
    }
}
