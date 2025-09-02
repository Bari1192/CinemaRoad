<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;
use App\Models\Reservation;
use Illuminate\Support\Facades\Gate;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(["movie", "user"])->get();
        return PurchaseResource::collection($purchases);
    }

    public function store(StorePurchaseRequest $request, Purchase $purchase)
    {
        $data = $request->validated();

        $newSpots = explode(',', $data["parkingspot"]);

        // Keresztellenőrzés végett!!
        $existingPurchases = Purchase::where('screening_id', $data['screening_id'])->get();
        $existingReservations = Reservation::where('screening_id', $data['screening_id'])->get();

        $takenSpots = [];
        foreach ($existingPurchases as $exp) {
            $takenSpots = array_merge($takenSpots, explode(',', $exp->parkingspot));
        }

        foreach ($existingReservations as $res) {
            $takenSpots = array_merge($takenSpots, explode(',', $res->parkingspot));
        }

        foreach ($newSpots as $spot) {
            if (in_array($spot, $takenSpots)) {
                return response()->json([
                    'message' => "A következő hely már foglalt: $spot"
                ], 422);
            }
        }


        $data['ticket_code'] = bin2hex(random_bytes(12));
        $purchase = Purchase::create($data);
        return new PurchaseResource($purchase);
    }

    public function show(Purchase $purchase)
    {
        return new PurchaseResource($purchase->load("screening", "location", 'movie', 'user'));
    }

    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {        
        Gate::authorize("update",$purchase);
        $data = $request->validated();

        $newSpots = explode(',', $data['parkingspot']);

        $existingPurchases = Purchase::where('screening_id', $data['screening_id'])
            ->where('id', '!=', $purchase->id)
            ->get();

        $existingReservations = Reservation::where('screening_id', $data['screening_id'])->get();

        $takenSpots = [];

        foreach ($existingPurchases as $p) {
            $takenSpots = array_merge($takenSpots, explode(',', $p->parkingspot));
        }

        // Keresztellenőrzés végett!!
        foreach ($existingReservations as $res) {
            $takenSpots = array_merge($takenSpots, explode(',', $res->parkingspot));
        }

        foreach ($newSpots as $spot) {
            if (in_array($spot, $takenSpots)) {
                return response()->json([
                    "message" => "A következő hely már foglalt: $spot"
                ], 422);
            }
        }

        $purchase->update($request->validated());
        return new PurchaseResource($purchase);
    }

    public function destroy(Purchase $purchase)
    {
        Gate::authorize("delete",$purchase);
        $data = Purchase::findOrFail($purchase->id);

        return ($data->delete()) ? response()->noContent() : abort(500);
    }
}
