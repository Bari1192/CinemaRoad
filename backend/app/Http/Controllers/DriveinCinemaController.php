<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDriveincinemaRequest;
use App\Http\Requests\UpdateDriveincinemaRequest;
use App\Http\Resources\DriveincinemaResource;
use App\Models\Driveincinema;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class DriveincinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():JsonResource
    {
        $data = Driveincinema::all();

        return DriveincinemaResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriveincinemaRequest $request)
    {
        $data = $request->validated();

        $newData = Driveincinema::create($data);

        return new DriveincinemaResource($newData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Driveincinema $driveincinema):JsonResource
    {
        $data = Driveincinema::findOrFail($driveincinema->id);

        return new DriveincinemaResource($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDriveincinemaRequest $request, Driveincinema $driveincinema)
    {
        $newData = $request->validated();

        $data = Driveincinema::findOrFail($driveincinema->id);

        $data->update($newData);

        return new DriveincinemaResource($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driveincinema $driveincinema):Response
    {
        $data = Driveincinema::findOrFail($driveincinema->id);

        return ($data->delete()) ? response()->noContent() : abort(500);
    }
}
