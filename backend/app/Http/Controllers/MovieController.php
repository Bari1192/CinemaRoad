<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function index()
    {
        return MovieResource::collection(Movie::all());
    }

    public function store(StoreMovieRequest $request, Movie $movie)
    {
        $validated = $request->validated();
        $movie = Movie::create($validated);
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

    public function storePoster(Request $request)
    {
        Log::info("storePoster method-ba eljutottunk!");
        $request->validate([
            'poster' => ['required', 'image', 'max:5120'],
            'type' => ['required', 'string', 'max:7']
        ]);

        if ($request->hasFile('poster')) {

            $file = $request->file('poster');
            $type = $request->input('type');

            $basename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $extension = $file->getClientOriginalExtension();

            $folder = "moviePosters/{$type}_Movies_img";

            $filename = $basename . '.' . $extension;

            // Mentse el a public mappába
            $path = $file->storeAs($folder, $filename, 'public');

            // Térjen vissza a relativePath-el
            return response()->json([
                'message' => 'Poster uploaded successfully',
                'poster_url' => asset('storage/' . $path),
                'path' => $path,
            ]);
        }
        return response()->json(['message' => 'No poster file uploaded'], 400);
    }
}
