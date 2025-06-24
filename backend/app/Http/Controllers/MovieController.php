<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        return MovieResource::collection(Movie::all());
    }

    public function store(StoreMovieRequest $request, Movie $movie)
    {
        $data = $request->validated();
        $movie = Movie::create($data);

        return new MovieResource($movie);
    }

    public function show(Movie $movie)
    {
        return new MovieResource($movie);
    }

    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $data = $request->validated();
        $movie->update($data);

        return new MovieResource($movie);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(null, 204);
    }
}
