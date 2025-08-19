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

        // Foglalni kívánt parkolóhelyek
        $newSpots = explode(',', $data['parkingspot']);

        // Összes foglalás az adott vetítésre
        $existingReservations = Reservation::where('screening_id', $data['screening_id'])->get();

        // Kigyűjtöm az összes foglalt helyet ebbe a tömbbe.
        $takenSpots = [];
        foreach ($existingReservations as $res) {
            $takenSpots = array_merge($takenSpots, explode(',', $res->parkingspot));
        }

        // Ha az új, foglalni kívánt helyek benne vannak a "takenSpots" tömbbe akkor hiba.
        foreach ($newSpots as $spot) {
            if (in_array($spot, $takenSpots)) {
                return response()->json([
                    'message' => "A következő hely már foglalt: $spot"
                ], 422);
            }
        }

        // Foglalni kívánt parkolóhelyek
        $newSpots = explode(',', $data['parkingspot']);

        // Összes foglalás az adott vetítésre
        $existingReservations = Reservation::where('screening_id', $data['screening_id'])->get();

        // Kigyűjtöm az összes foglalt helyet ebbe a tömbbe.
        $takenSpots = [];
        foreach ($existingReservations as $res) {
            $takenSpots = array_merge($takenSpots, explode(',', $res->parkingspot));
        }

        // Ha az új, foglalni kívánt helyek benne vannak a "takenSpots" tömbbe akkor hiba.
        foreach ($newSpots as $spot) {
            if (in_array($spot, $takenSpots)) {
                return response()->json([
                    'message' => "A következő hely már foglalt: $spot"
                ], 422);
            }
        }

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
