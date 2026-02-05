<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GymClassController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes (Landing Page)
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/plans', [PlanController::class, 'index']);
Route::get('/trainers', [TrainerController::class, 'index']);
Route::get('/classes', [GymClassController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/
// Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    // Users
    Route::apiResource('users', UserController::class);
    Route::get('/users/role/{role}', [UserController::class, 'byRole']);

    // Members & Trainers
    Route::apiResource('members', MemberController::class);
    Route::apiResource('trainers', TrainerController::class)->except(['index']);

    // Plans
    Route::apiResource('plans', PlanController::class)->except(['index']);
    Route::patch('/plans/{plan}/status', [PlanController::class, 'toggleStatus']);

    // Memberships
    Route::apiResource('memberships', MembershipController::class);

    // Sessions
    Route::apiResource('classes', GymClassController::class)->except(['index']);

    // Categories
    Route::apiResource('categories', CategoryController::class);

    // Bookings (member يعمل booking)
    Route::post('/bookings', [BookingController::class, 'store']);
    Route::get('/my-bookings', [BookingController::class, 'myBookings']);

    // Admin bookings
    Route::apiResource('bookings', BookingController::class)->except(['store']);

    // Dashboard
    Route::get('/dashboard/stats', [DashboardController::class, 'stats']);
    Route::get('/dashboard/membership-distribution', [DashboardController::class, 'membershipDistribution']);
// });
