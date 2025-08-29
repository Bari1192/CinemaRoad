<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'location_id' => $this->location_id,
            'screening_id' => $this->screening_id,
            'movie_id' => $this->movie_id,
            'ticket_code' => $this->ticket_code,
            'guest_email' => $this->guest_email,
            "userEmail" => $this->user->email ?? null,
            'parkingspot' => $this->parkingspot,
            "movieTitle" => $this->movie->title,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
