<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriveInCinemaController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\UserController;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource("screenings", ScreeningController::class);
Route::apiResource("drive_in_cinemas", DriveInCinemaController::class);
Route::apiResource("/reservations", ReservationController::class);

Route::middleware(['auth:sanctum'])->group(function() {
    // Film feltöltés védve
    Route::apiResource('movies', MovieController::class);

    // Kép feltöltés védve
    Route::post('/movies/upload-poster', [MovieController::class, 'storePoster'])
    ->can('uploadPoster', Movie::class);
});

// Auth
Route::post("/register", [RegisterController::class, "store"]);
Route::post("/authenticate", [AuthController::class, "authenticate"])->name("auth.authenticate");
Route::apiResource('/users', UserController::class);

Route::apiResource('/purchases', PurchaseController::class);
