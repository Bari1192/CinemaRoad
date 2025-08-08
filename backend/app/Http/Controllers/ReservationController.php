<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Jobs\SendReservationConfirmation;
use App\Mail\ReservationConfirmation;
use App\Models\Reservation;
use App\Models\Screening;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::all();
        return ReservationResource::collection($reservations);
    }

    public function store(StoreReservationRequest $request)
    {
        $data = $request->validated();

        $newReservation = Reservation::create($data);

        $newReservation->load([
            'user',
            'screening.movie',
            'screening.driveInCinema',
            'location'
        ]);

        return new ReservationResource($newReservation);
    }

    public function show(Reservation $reservation)
    {
        $reservation->load(['user', 'screening', 'driveInCinema']);

        return new ReservationResource($reservation);
    }

    public function update(Request $request, Reservation $reservation)
    {
        // Ez lehet nem kell.
    }

    public function destroy(Reservation $reservation)
    {
        // Ez lehet nem kell.
    }
}
