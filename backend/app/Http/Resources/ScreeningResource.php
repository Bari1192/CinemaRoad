<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScreeningResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'movie_id' => $this->movie_id,
            'drive_in_cinema_id' => $this->drive_in_cinema_id,
            'start_time' => $this->start_time,
            "drivein_cinema" => new DriveInCinemaResource($this->whenLoaded("DriveInCinema")),
            "movie" => new MovieResource($this->whenLoaded("movie"))
        ];
    }
}
