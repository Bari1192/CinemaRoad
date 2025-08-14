<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
use Illuminate\Http\Request;

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

        $data['confirmation'] = bin2hex(random_bytes(12)); //24 karakteres lesz majd!
        $newReservation = Reservation::create($data);

        $newReservation->load([
            'user',
            'screening.movie',
            'screening.driveInCinema',
            'location'
        ]);

        return new ReservationResource($newReservation);
    }

    public function show($id)
    {

        $reservation = Reservation::findOrFail($id);

        $reservation->load(['user', 'screening', 'location']);

        return new ReservationResource($reservation);
    }

    public function update(Request $request, Reservation $reservation)
    {
        // De, kell!
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        return ($reservation->delete()) ? response()->noContent() : abort(500);
    }
}
