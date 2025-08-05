<?php

namespace App\Http\Resources;

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
            'release_date' =>date_format($this->release_date,'Y-m-d') ,
            'description' => $this->description,
            'duration_min' => $this->duration_min,
            'poster_url' => $this->poster_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
