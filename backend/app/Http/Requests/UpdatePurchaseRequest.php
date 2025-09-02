<?php

namespace App\Http\Requests;

use App\Models\Purchase;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdatePurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        $purchase = $this->route("purchase");
        return Gate::authorize('update', $purchase)->allowed();
    }

    public function rules(): array
    {
        return [
            'status'=> ['nullable', 'string', 'max:16'],
            'guest_email' => ['nullable', 'email', 'max:128'],
            'movie_id' => ['integer', 'exists:movies,id'],
            'location_id' => ['integer', 'exists:drive_in_cinemas,id'],
            'screening_id' => ['integer', 'exists:screenings,id'],
            "parkingspot" => ["required", "string"],
        ];
    }
}
