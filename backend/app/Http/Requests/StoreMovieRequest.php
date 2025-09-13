<?php

namespace App\Http\Requests;

use App\Models\Movie;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreMovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::authorize('create', Movie::class)->allowed();
    }

    public function rules(): array
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
            'duration_min' => ['required', 'integer', 'min:0'],
            'poster_url' => ['required', 'string'],
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
