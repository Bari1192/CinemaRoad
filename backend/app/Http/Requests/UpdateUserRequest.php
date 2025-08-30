<?php

namespace App\Http\Requests;

use App\Rules\ValidEmailDomain;
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
            "email" => [
                "required",
                "min:8",
                "max:50",
                "email:rfc",
                new ValidEmailDomain(),
            ],
            "phone" => [
                "required",
                "string",
                "max:25",
                "min:12",
            ],
            "password" => ["required", "string", "min:8"],
        ];
    }
}
