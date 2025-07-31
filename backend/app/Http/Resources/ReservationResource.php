<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
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
            "user_id" => $this->user_id,
            "screening_id" => $this->screening_id,
            "location_id" => $this->location_id,
            "parkingspot" => $this->parkingspot,
            "reserved_at" => $this->reserved_at,
            "created_at" => $this->created_at,
        ];
    }
}
