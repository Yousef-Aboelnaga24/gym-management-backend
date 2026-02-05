<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Trainer,
    Category,
    Member,
    Plan,
    Membership,
    GymClass,
    Booking,
};

class HomeController extends Controller
{
    public function index()
    {
        return response()->json([
            'trainers' => Trainer::all(),
            'categories' => Category::all(),
            'members' => Member::all(),
            'plans' => Plan::all(),
            'memberships' => Membership::all(),
            'classes' => GymClass::with(['trainer', 'category'])->get(),
            'bookings' => Booking::all(),
        ]);
    }
}
