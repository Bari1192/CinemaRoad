<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriveInCinemaRequest;
use App\Http\Requests\UpdateDriveInCinemaRequest;
use App\Http\Resources\DriveInCinemaResource;
use App\Models\DriveInCinema;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class DriveInCinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResource
    {
        $data = DriveInCinema::all();

        return DriveInCinemaResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriveInCinemaRequest $request)
    {
        $data = $request->validated();

        $newData = DriveInCinema::create($data);

        return new DriveInCinemaResource($newData);
    }

    /**
     * Display the specified resource.
     */
    public function show(DriveInCinema $DriveInCinema):JsonResource
    {
        $data = DriveInCinema::findOrFail($DriveInCinema->id);

        return new DriveInCinemaResource($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDriveInCinemaRequest $request, DriveInCinema $DriveInCinema)
    {
        $newData = $request->validated();

        $data = DriveInCinema::findOrFail($DriveInCinema->id);

        $data->update($newData);

        return new DriveInCinemaResource($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriveInCinema $DriveInCinema):Response
    {
        $data = DriveInCinema::findOrFail($DriveInCinema->id);

        return ($data->delete()) ? response()->noContent() : abort(500);
    }
}
