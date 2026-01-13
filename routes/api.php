<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberShipController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TrainerController;

Route::apiResource('members', MemberController::class);
Route::apiResource('trainers', TrainerController::class);
Route::apiResource('plan', PlanController::class);
Route::apiResource('membership', MembershipController::class);
