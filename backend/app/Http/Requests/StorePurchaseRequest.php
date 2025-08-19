<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "location_id" => ["required", "integer", "min:0", "exists:drive_in_cinemas,id"],
            'movie_id' => ['required', 'integer', 'exists:movies,id'],
            "screening_id" => ["required", "integer", "min:0", "exists:screenings,id"],
            'guest_email'    => [ // Email csak akkor kell, ha guest mert fronton majd session-ből behivatkozod az e-mailt!
                'required_without:user_id',
                'email',
                'max:128'
            ],
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            "parkingspot" => ["required", "string"],
        ];
    }
}
