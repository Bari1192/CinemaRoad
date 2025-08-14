<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            "user_id" => $this->user_id,
            "confirmation" => $this->confirmation,
            "location_id" => $this->location_id,
            "screening_id" => $this->screening_id,
            "parkingspot" => $this->parkingspot,
            "reserved_at" => $this->reserved_at,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d h:m'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d h:m'),
        ];
    }
}
