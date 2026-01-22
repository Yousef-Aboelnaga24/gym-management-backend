<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class DashboardController extends Controller
{
    public function index(Request $request){
        $user = $request->user();

if ($user->role === 'admin') {
    # code...
}
    }
}
