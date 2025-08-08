<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => ["required",
                        "string",
                        "max:60",
                        "min:6"], // Legrövidebb név: Úr Pál (?) tudjon regisztrálni.

            "email" => ["required",
                        "email:rfc",
                        "min:15",
                        "max:50",
                        'regex:/@(?:gmail|freemail|yahoo|citromail|outlook)\.(com|hu)$/'],

            "phone" => ["required",
                        "string",
                        "max:50",
                        "min:6",
                        "regex:/^\+?(06)?(20|30|40|70)\d{7}$/"],

            "password" => ["required",
                        "string",
                        "min:8",
                        "max:50",
                        'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,50}$/'],
        ];
    }
}
