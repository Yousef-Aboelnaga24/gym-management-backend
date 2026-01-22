<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/', [HomeController::class, 'index']);
Route::apiResource('members', MemberController::class);
Route::apiResource('trainers', TrainerController::class);
Route::apiResource('plans', PlanController::class);
Route::patch('/plans/{plan}/status', [PlanController::class, 'toggleStatus']);
Route::apiResource('memberships', MembershipController::class);
Route::apiResource('bookings', BookingController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('sessions', SessionController::class);
