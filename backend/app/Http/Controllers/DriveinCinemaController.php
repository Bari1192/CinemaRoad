<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriveinCinemaRequest;
use App\Http\Requests\UpdateDriveinCinemaRequest;
use App\Http\Resources\DriveinCinemaResource;
use App\Models\DriveinCinema;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class DriveinCinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResource
    {
        $data = DriveinCinema::all();

        return DriveinCinemaResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriveinCinemaRequest $request)
    {
        $data = $request->validated();

        $newData = DriveinCinema::create($data);

        return new DriveinCinemaResource($newData);
    }

    /**
     * Display the specified resource.
     */
    public function show(DriveinCinema $driveincinema):JsonResource
    {
        $data = DriveinCinema::findOrFail($driveincinema->id);

        return new DriveinCinemaResource($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDriveinCinemaRequest $request, DriveinCinema $driveincinema)
    {
        $newData = $request->validated();

        $data = DriveinCinema::findOrFail($driveincinema->id);

        $data->update($newData);

        return new DriveinCinemaResource($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DriveinCinema $driveincinema):Response
    {
        $data = DriveinCinema::findOrFail($driveincinema->id);

        return ($data->delete()) ? response()->noContent() : abort(500);
    }
}
