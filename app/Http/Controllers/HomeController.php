<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    Trainer,
    Category,
    Member,
    Plan,
    Membership,
    Session,
    Booking
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
            'sessions' => Session::with(['trainer', 'category'])->get(),
            'bookings' => Booking::all(),
        ]);
    }
}