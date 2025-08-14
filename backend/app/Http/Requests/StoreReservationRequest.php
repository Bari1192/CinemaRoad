<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "user_id" => ["integer", "min:0", "exists:users,id"],
            "screening_id" => ["required", "integer", "min:0", "exists:screenings,id"],
            "reserved_at" => ["required", "date"],
            "parkingspot" => ["required", "string"],
            "location_id" => ["required", "integer", "min:0", "exists:drive_in_cinemas,id"]
        ];
    }
}
