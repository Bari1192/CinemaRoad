<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:20'],
            'director' => ['required', 'string', 'max:50'],
            'release_date' => [
                'required',
                'date',
                'after_or_equal:' . now()->subDays(180)->format('Y-m-d'),
                'before_or_equal:' . now()->format('Y-m-d')
            ],
            'age_limit' => ['required', 'integer', 'min:0', 'max:18'],
            'duration_min' => ['required', 'integer', 'min:0'],
            'poster_url' => ['required', 'string', 'url'],
            'actors' => [
                Rule::when(
                    request('type') !== 'Family',
                    ['nullable', 'array'],
                    ['nullable', 'prohibited']
                )
            ],
            'actors.*' => ['string'],
        ];
    }
}
