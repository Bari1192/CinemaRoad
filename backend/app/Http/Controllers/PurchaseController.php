<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Http\Resources\PurchaseResource;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::all();
        return PurchaseResource::collection($purchases);
    }

    public function store(StorePurchaseRequest $request, Purchase $purchase)
    {
        $data = $request->validated();
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
        $purchase->update($request->validated());
        return new PurchaseResource($purchase);
    }

    public function destroy(Purchase $purchase)
    {
        $data = Purchase::findOrFail($purchase->id);

        return ($data->delete()) ? response()->noContent() : abort(500);
    }
}
