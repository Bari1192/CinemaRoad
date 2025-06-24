<?php

use App\Http\Controllers\DriveInCinemaController;
use App\Http\Controllers\ScreeningController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource("screenings", ScreeningController::class);
Route::apiResource("DriveInCinemas", DriveInCinemaController::class);