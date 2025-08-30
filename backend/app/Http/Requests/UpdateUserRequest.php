<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "email" => ["required", "email:rfc"],
            "phone" => ["required", "string", "max:50"],
            "password" => ["required", "string", "min:8"],
        ];
    }
}
