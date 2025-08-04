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
    public function index():JsonResource
    {
        $data = Screening::with(["DriveInCinema", "movie"])->get();

        return ScreeningResource::collection($data);
    }

    public function store(StoreScreeningRequest $request)
    {
        $data = $request->validated();

        $newScreening = Screening::create($data);

        return new ScreeningResource($newScreening);
    }

    public function show(Screening $screening):JsonResource
    {
        return new ScreeningResource($screening->load("DriveInCinema"));
    }

    public function update(UpdateScreeningRequest $request, Screening $screening)
    {
        $newData = $request->validated();

        $data = Screening::findOrFail($screening->id);

        $data->update($newData);

        return new ScreeningResource($data);
    }

    public function destroy(Screening $screening):Response
    {
        $data = Screening::findOrFail($screening->id);

        return ($data->delete()) ? response()->noContent() : abort(500);
    }
}
