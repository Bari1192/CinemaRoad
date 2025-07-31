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

        $newReservation = Reservation::create($data);

        return new ReservationResource($newReservation);
    }

    public function show(Reservation $reservation)
    {
        $reservation->load("location");

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
