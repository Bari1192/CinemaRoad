<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MovieResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'director' => $this->director,
            'release_date' => Carbon::parse($this->release_date)->format('Y-m-d'),
            'description' => $this->description,
            'duration_min' => $this->duration_min,
            'poster_url' => $this->poster_url,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d h:m'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d h:m'),
        ];
    }
}
