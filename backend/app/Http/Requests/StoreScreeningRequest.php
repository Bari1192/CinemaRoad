<?php

namespace App\Http\Requests;

use App\Models\Screening;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreScreeningRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::authorize('create', Screening::class)->allowed();

    }

    public function rules(): array
    {
        return [
            'movie_id' => ['required', 'integer', 'exists:movies,id'],
            'drive_in_cinema_id' => ['required', 'integer', 'exists:drive_in_cinemas,id'],
            'start_time' => ['required', 'date_format:Y-m-d H:i:s'],
        ];
    }
}
