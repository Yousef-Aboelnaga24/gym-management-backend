<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;

use App\Http\Controllers\MemberShipController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::apiResource('members', MemberController::class);
Route::apiResource('trainers', TrainerController::class);
Route::apiResource('plans', PlanController::class);
Route::apiResource('memberships', MembershipController::class);
Route::apiResource('bookings', BookingController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('sessions', SessionController::class);


?>