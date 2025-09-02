<?php

namespace App\Http\Requests;

use App\Models\Reservation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreReservationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::authorize('create', Reservation::class)->allowed();
    }
    public function rules(): array
    {
        return [
            "user_id" => ["required", "min:0", "exists:users,id"],
            "screening_id" => ["required", "integer", "min:0", "exists:screenings,id"],
            "reserved_at" => ["required", "date"],
            "parkingspot" => ["required", "string"],
            "location_id" => ["required", "integer", "min:0", "exists:drive_in_cinemas,id"]
        ];
    }
}
