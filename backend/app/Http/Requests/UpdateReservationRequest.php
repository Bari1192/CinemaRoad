<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Majd be kell állítani hogy csak admin tudjon update-elni!
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
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
