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


// ----------------------------------------------------------------------------------------
// F O G L A L Á S O K
Route::apiResource("/reservations", ReservationController::class)->middleware('auth:sanctum');
// ----------------------------------------------------------------------------------------


// ----------------------------------------------------------------------------------------
// F I L M E K
// Minden engedélyezett, kivéve a store és update. Azok maradjanak levédve.
Route::apiResource('movies', MovieController::class)->except("store", "update");

Route::middleware(['auth:sanctum'])->group(function () {

    // Film feltöltés védve
    Route::post("/movies", [MovieController::class, "store"]);

    // Film módosítása
    Route::put("/movies/{movie}", [MovieController::class, "update"]);

    // Kép feltöltés védve
    Route::post('/movies/upload-poster', [MovieController::class, 'storePoster'])
        ->can('uploadPoster', Movie::class);
});
// ----------------------------------------------------------------------------------------


// Auth
Route::post("/register", [RegisterController::class, "store"]);
Route::post("/authenticate", [AuthController::class, "authenticate"])->name("auth.authenticate");
Route::apiResource('/users', UserController::class);


// ----------------------------------------------------------------------------------------
// V Á S Á R L Á S O K
Route::apiResource('/purchases', PurchaseController::class)->except("update", "destroy");

Route::middleware('auth:sanctum')->group(function () {
    Route::put('/purchases/{purchase}', [PurchaseController::class, 'update']);
    Route::delete('/purchases/{purchase}', [PurchaseController::class, 'destroy']);
});
// ----------------------------------------------------------------------------------------