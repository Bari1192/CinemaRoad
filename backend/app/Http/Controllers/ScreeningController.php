<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScreeningRequest;
use App\Http\Requests\UpdateScreeningRequest;
use App\Http\Resources\ScreeningResource;
use App\Models\Screening;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResource
    {
        $data = Screening::with(["driveinCinema"])->get();

        return ScreeningResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScreeningRequest $request)
    {
        $data = $request->validated();

        $newScreening = Screening::create($data);

        return new ScreeningResource($newScreening);
    }

    /**
     * Display the specified resource.
     */
    public function show(Screening $screening):JsonResource
    {
        return new ScreeningResource($screening->load("driveinCinema"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScreeningRequest $request, Screening $screening)
    {
        $newData = $request->validated();

        $data = Screening::findOrFail($screening->id);

        $data->update($newData);

        return new ScreeningResource($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Screening $screening):Response
    {
        $data = Screening::findOrFail($screening->id);

        return ($data->delete()) ? response()->noContent() : abort(500);
    }
}
