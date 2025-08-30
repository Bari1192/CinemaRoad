<?php

namespace App\Http\Requests;

use App\Rules\ValidEmailDomain;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => [
                "required",
                "string",
                "max:60",
                "min:6"
            ],

            "email" => [
                "required",
                "min:8",
                "max:50",
                "email:rfc",
                new ValidEmailDomain(), // Meghívjuk, hogy végezze el az ellenőrzési függvényt!
            ],

            "phone" => [
                "required",
                "string",
                "max:25",
                "min:12",
            ],

            "password" => [
                "required",
                "string",
                "min:8",
                "max:50",
                'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,50}$/'
            ],
        ];
    }
}
