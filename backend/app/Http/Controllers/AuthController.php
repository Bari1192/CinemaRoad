<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authenticate(AuthenticateRequest $request) {
        $credentials = $request->validated();
        
        if(Auth::attempt($credentials)) {
            $user = $request->user();

            $token = $request->user()->createToken("app");
            
            return response()->json([
                'data' => [
                    'token' => $token->plainTextToken
                ]
            ]);


        } else {
            return response()->json([
                'data' => [
                    'message' => 'Unauthorized'
                ]], 401);
        }
    }
}
