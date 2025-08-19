<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->validated();

        $userData = User::findOrFail($id);

        $userData->update($data);

        return new UserResource($userData);
    }

    public function destroy(string $id)
    {
        //
    }
}
