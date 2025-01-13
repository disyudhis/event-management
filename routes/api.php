<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendeeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::apiResource('events', EventController::class)->only(['index', 'show']);
Route::apiResource('events', EventController::class)->only(['store', 'update', 'destroy'])->middleware(['auth:sanctum', 'throttle:api']);
Route::apiResource('events.attendees', AttendeeController::class)
    ->scoped()->only(['store', 'destroy'])->middleware(['auth:sanctum', 'throttle:api']);
Route::apiResource('events.attendees', AttendeeController::class)
    ->scoped()->only(['index', 'show']);
