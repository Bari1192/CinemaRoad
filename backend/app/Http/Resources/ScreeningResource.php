<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScreeningResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "movie_id"=>$this->movie_id,
            "DriveInCinema_id"=>$this->DriveInCinema_id,
            "start_time"=>$this->start_time,
            "drivein_cinema" => new DriveInCinemaResource($this->whenLoaded("DriveInCinema"))
        ];
    }
}
