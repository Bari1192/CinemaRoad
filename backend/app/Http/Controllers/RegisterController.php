<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function store(RegisterUserRequest $request) :JsonResponse
    {
        $data = $request->validated();

        $user = User::create($data);

        return response()->json([
            "data" => [
                "message" => "A(z) $user->email sikeresen regisztrált."
            ]
        ]);
    }
}
