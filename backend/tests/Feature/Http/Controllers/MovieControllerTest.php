<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Movie;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MovieControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_can_get_all_movies()
    {
        Movie::create([
            'title' => 'Sample Movie',
            'duration_min' => 90,
        ]);
        $response = $this->getJson('/api/movies');
        $response->assertStatus(200);
    }

    public function test_get_all_movies_returns_data_key()
    {
        Movie::create([
            'title' => 'Sample Movie',
            'duration_min' => 90,
        ]);

        $response = $this->getJson('/api/movies');
        $response->assertJsonStructure(['data']);
    }

    public function test_it_returns_non_empty_data_array_when_getting_all_movies()
    {
        Movie::create([
            'title' => 'Sample Movie',
            'duration_min' => 90,
        ]);
        $response = $this->getJson('/api/movies');
        $this->assertNotEmpty($response->json('data'));
    }

    public function test_it_returns_successful_response_when_creating_a_movie()
    {
        $movieData = [
            'title' => 'Test Movie Title',
            'description' => 'This is a test movie description.',
            'duration_min' => 120,
            'poster_url' => 'http://pelda-default-url.com/poster.jpg',
        ];
        $response = $this->postJson('/api/movies', $movieData);
        $response->assertStatus(201); 
    }

    public function test_it_stores_movie_in_database_when_creating_it()
    {
        $movieData = [
            'title' => 'Test Movie Title',
            'description' => 'This is a test movie description.',
            'duration_min' => 120,
            'poster_url' => 'http://pelda-default-url.com/poster.jpg',
        ];
        $this->postJson('/api/movies', $movieData);
        $this->assertDatabaseHas('movies', ['title' => 'Test Movie Title']);
    }

    public function test_it_returns_correct_json_structure_after_creating_movie()
    {
        $movieData = [
            'title' => 'Test Movie Title',
            'description' => 'This is a test movie description.',
            'duration_min' => 120,
            'poster_url' => 'http://pelda-default-url.com/poster.jpg',
        ];
        $response = $this->postJson('/api/movies', $movieData);
        $response->assertJsonStructure([
            'data' => ['id', 'title', 'description', 'duration_min', 'poster_url', 'created_at', 'updated_at']
        ]);
    }

    public function test_it_returns_movie_data_with_correct_title_after_creating_it()
    {
        $movieData = [
            'title' => 'New Movie Title',
            'description' => 'Description for new movie',
            'duration_min' => 90,
            'poster_url' => 'http://pelda-default-url.com/new_poster.png',
        ];
        $response = $this->postJson('/api/movies', $movieData);
        $response->assertJsonFragment(['title' => 'New Movie Title']);
    }

    public function test_it_returns_successful_response_for_showing_a_movie()
    {
        $movie = Movie::create([
            'title' => 'Specific Movie',
            'duration_min' => 100,
        ]);
        $response = $this->getJson("/api/movies/{$movie->id}");
        $response->assertStatus(200);
    }

    public function test_it_returns_correct_movie_title_when_showing_a_movie()
    {
        $movie = Movie::create(['title' => 'Specific Movie Title', 'duration_min' => 100]);
        $response = $this->getJson("/api/movies/{$movie->id}");
        $response->assertJsonFragment(['title' => 'Specific Movie Title']);
    }

    public function test_it_returns_correct_json_structure_when_showing_a_movie()
    {
        $movie = Movie::create(['title' => 'Specific Movie', 'duration_min' => 100]);
        $response = $this->getJson("/api/movies/{$movie->id}");
        $response->assertJsonStructure([
            'data' => ['id', 'title', 'description', 'duration_min', 'poster_url', 'created_at', 'updated_at']
        ]);
    }

    public function test_it_returns_404_when_showing_a_non_existent_movie()
    {
        $response = $this->getJson('/api/movies/9999');
        $response->assertStatus(404); 
    }

    public function test_it_returns_successful_response_when_updating_an_existing_movie()
    {
        $movie = Movie::create([
            'title' => 'Original Movie',
            'duration_min' => 100,
        ]);
        $updatedData = [
            'title' => 'Updated Movie Title',
            'duration_min' => 150,
        ];
        $response = $this->putJson("/api/movies/{$movie->id}", $updatedData);
        $response->assertStatus(200);
    }


    public function test_it_updates_movie_data_in_database()
    {
        $movie = Movie::create([
            'title' => 'Original Movie',
            'duration_min' => 100,
        ]);
        $updatedData = [
            'title' => 'Changed Title',
        ];
        $this->putJson("/api/movies/{$movie->id}", $updatedData);
        $this->assertDatabaseHas('movies', ['id' => $movie->id, 'title' => 'Changed Title']);
    }

    public function test_it_returns_correct_json_structure_after_updating_movie()
    {
        $movie = Movie::create([
            'title' => 'Original Movie',
            'duration_min' => 100,
        ]);
        $updatedData = [
            'title' => 'Updated Title Again',
        ];
        $response = $this->putJson("/api/movies/{$movie->id}", $updatedData);
        $response->assertJsonStructure([
            'data' => ['id', 'title', 'description', 'duration_min', 'poster_url', 'created_at', 'updated_at']
        ]);
    }

    public function test_it_returns_updated_movie_data_after_updating_it()
    {
        $movie = Movie::create([
            'title' => 'Original Movie',
            'duration_min' => 100,
        ]);
        $updatedData = [
            'title' => 'Finally Updated',
        ];
        $response = $this->putJson("/api/movies/{$movie->id}", $updatedData);
        $response->assertJsonFragment(['title' => 'Finally Updated']);
    }

    public function test_it_returns_404_when_updating_a_non_existent_movie()
    {
        $updatedData = [
            'title' => 'Non Existent Update',
        ];
        $response = $this->putJson('/api/movies/9999', $updatedData);
        $response->assertStatus(404); 
    }

    public function test_it_returns_successful_response_when_deleting_a_movie()
    {
        $movie = Movie::create([
            'title' => 'Movie to Delete',
            'duration_min' => 100,
        ]);
        $response = $this->deleteJson("/api/movies/{$movie->id}");
        $response->assertStatus(204); 
    }
    public function test_it_removes_movie_from_database_after_deleting_it()
    {
        $movie = Movie::create([
            'title' => 'Movie to Delete',
            'duration_min' => 100,
        ]);
        $this->deleteJson("/api/movies/{$movie->id}");
        $this->assertDatabaseMissing('movies', ['id' => $movie->id]);
    }

    public function test_it_returns_404_when_deleting_a_non_existent_movie()
    {
        $response = $this->deleteJson('/api/movies/9999');
        $response->assertStatus(404); 
    }


    public function test_it_returns_422_when_creating_movie_without_title()
    {
        $movieData = [
            'description' => 'Test description',
            'duration_min' => 100,
            'poster_url' => 'http://pelda-default-url.com/poster.jpg',
        ];
        $response = $this->postJson('/api/movies', $movieData);
        $response->assertStatus(422);
    }

    public function test_it_returns_422_when_creating_movie_with_too_long_title()
    {
        $movieData = [
            'title' => str_repeat('A', 256), 
            'duration_min' => 100,
        ];
        $response = $this->postJson('/api/movies', $movieData);
        $response->assertStatus(422);
    }

    public function test_it_returns_422_when_creating_movie_with_negative_duration()
    {
        $movieData = [
            'title' => 'Valid Title',
            'duration_min' => -10,
        ];
        $response = $this->postJson('/api/movies', $movieData);
        $response->assertStatus(422);
    }

    public function test_it_returns_422_when_updating_movie_with_too_long_title()
    {
        $movie = Movie::create([
            'title' => 'Original Movie',
            'duration_min' => 100,
        ]);
        $updatedData = [
            'title' => str_repeat('B', 256),
        ];
        $response = $this->putJson("/api/movies/{$movie->id}", $updatedData);
        $response->assertStatus(422);
    }

    public function test_it_returns_422_when_updating_movie_with_negative_duration()
    {
        $movie = Movie::create([
            'title' => 'Original Movie',
            'duration_min' => 100,
        ]);
        $updatedData = [
            'duration_min' => -5,
        ];
        $response = $this->putJson("/api/movies/{$movie->id}", $updatedData);
        $response->assertStatus(422);
    }
}
