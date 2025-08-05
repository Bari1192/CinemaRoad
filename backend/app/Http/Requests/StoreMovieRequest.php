<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:20'],
            'director' => ['required', 'string', 'max:50'],
            'release_date' => ['required', Rule::date('YY:mm')->beforeOrEqual(today()->subMonth(6))],
            'duration_min' => ['required', 'integer', 'min:0'],
            'poster_url' => ['required', 'string', 'url'],
        ];
    }
}
