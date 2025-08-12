<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MovieControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_it_returns_successful_status_when_getting_all_movies()
    {
        Movie::create([
            'title' => 'Test Movie for Controller',
            'type' => 'Action',
            'description' => 'A description for the test movie.',
            'duration_min' => 100,
            'poster_url' => 'http://example.com/test_movie_poster.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $response = $this->getJson('/api/movies');
        $response->assertStatus(200);
    }


    public function test_it_returns_data_key_when_getting_all_movies()
    {
        Movie::create([
            'title' => 'Test Movie for Controller',
            'type' => 'Action',
            'description' => 'A description for the test movie.',
            'duration_min' => 100,
            'poster_url' => 'http://example.com/test_movie_poster.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $response = $this->getJson('/api/movies');
        $response->assertJsonStructure(['data']);
    }


    public function test_it_returns_non_empty_data_array_when_getting_all_movies_with_data()
    {
        Movie::create([
            'title' => 'Test Movie for Controller',
            'type' => 'Action',
            'description' => 'A description for the test movie.',
            'duration_min' => 100,
            'poster_url' => 'http://example.com/test_movie_poster.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $response = $this->getJson('/api/movies');
        $this->assertNotEmpty($response->json('data'));
    }

    public function test_it_returns_201_status_when_creating_a_movie_successfully()
    {
        $movieData = [
            'title' => 'Test Movie Title',
            'description' => 'This is a test movie description.',
            'duration_min' => 120,
            'poster_url' => 'http://pelda-default-url.com/poster.jpg',
            'type' => 'Action',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $response = $this->postJson('/api/movies', $movieData);
        $response->assertStatus(201);
    }


    public function test_it_stores_movie_in_database_when_creating_it()
    {
        $movieData = [
            'title' => 'Test Movie for DB Storage',
            'description' => 'This is a test movie description.',
            'duration_min' => 120,
            'poster_url' => 'http://pelda-default-url.com/poster.jpg',
            'type' => 'Action',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $this->postJson('/api/movies', $movieData);
        $this->assertDatabaseHas('movies', ['title' => 'Test Movie for DB Storage']);
    }


    public function test_it_returns_correct_json_structure_after_creating_movie()
    {
        $movieData = [
            'title' => 'Test Movie Title',
            'description' => 'This is a test movie description.',
            'duration_min' => 125,
            'poster_url' => 'http://pelda-default-url.com/poster.jpg',
            'type' => 'Action',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $response = $this->postJson('/api/movies', $movieData);
        $response->assertJsonStructure([
            'data' => ['id', 'title', 'description', 'duration_min', 'poster_url', 'type', 'release_date', 'director', 'created_at', 'updated_at']
        ]);
    }


    public function test_it_returns_movie_data_with_correct_title_after_creating_it()
    {
        $movieData = [
            'title' => 'New Movie Title Returned',
            'description' => 'This is a test movie description.',
            'duration_min' => 90,
            'poster_url' => 'http://pelda-default-url.com/poster.jpg',
            'type' => 'Action',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $response = $this->postJson('/api/movies', $movieData);
        $response->assertJsonFragment(['title' => 'New Movie Title Returned']);
    }


    public function test_it_returns_movie_data_with_correct_duration_after_creating_it()
    {
        $movieData = [
            'title' => 'Movie for Duration Check',
            'description' => 'Description for duration check',
            'type' => 'Action',
            'duration_min' => 135,
            'poster_url' => 'http://pelda-default-url.com/duration_poster.png',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $response = $this->postJson('/api/movies', $movieData);
        $response->assertJsonFragment(['duration_min' => 135]);
    }

    public function test_it_returns_successful_status_for_showing_a_movie()
    {
        $movie = Movie::create([
            'title' => 'Specific Movie',
            'duration_min' => 100,
            'description' => 'Description for duration check',
            'type' => 'Action',
            'poster_url' => 'http://pelda-default-url.com/show_poster.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $response = $this->getJson("/api/movies/{$movie->id}");
        $response->assertStatus(200);
    }


    public function test_it_returns_correct_movie_title_when_showing_a_movie()
    {
        $movie = Movie::create([
            'title' => 'Specific Movie Title',
            'duration_min' => 100,
            'description' => 'Description for duration check',
            'type' => 'Action',
            'poster_url' => 'http://pelda-default-url.com/show_title_poster.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $response = $this->getJson("/api/movies/{$movie->id}");
        $response->assertJsonFragment(['title' => 'Specific Movie Title']);
    }


    public function test_it_returns_correct_json_structure_when_showing_a_movie()
    {
        $movie = Movie::create([
            'title' => 'Specific Movie for Structure',
            'duration_min' => 100,
            'description' => 'Description for duration check',
            'type' => 'Action',
            'poster_url' => 'http://pelda-default-url.com/show_structure_poster.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
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

    public function test_it_returns_successful_status_when_updating_an_existing_movie()
    {
        $movie = Movie::create([
            'title' => 'Original Movie',
            'description' => 'Description for duration check',
            'duration_min' => 100,
            'type' => 'Action',
            'poster_url' => 'http://pelda-default-url.com/update_poster.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $updatedData = [
            'title' => 'Updated Movie Title',
            'duration_min' => 150,
            'description' => 'Description for duration check',
            'type' => 'Action',
            'poster_url' => 'http://pelda-default-url.com/update_poster.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
        ];
        $response = $this->putJson("/api/movies/{$movie->id}", $updatedData);
        $response->assertStatus(200);
    }


    public function test_it_updates_movie_data_in_database()
    {
        $movie = Movie::create([
            'title' => 'Original Movie for DB Update',
            'description' => 'Description',
            'duration_min' => 100,
            'type' => 'Action',
            'poster_url' => 'http://pelda-default-url.com/db_update_poster.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $updatedData = [
            'title' => 'Changed Title in DB',
            'description' => 'Description for duration check',
            'duration_min' => 100,
            'type' => 'Action',
            'poster_url' => 'http://pelda-default-url.com/update_poster.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
        ];
        $this->putJson("/api/movies/{$movie->id}", $updatedData);
        $this->assertDatabaseHas('movies', ['id' => $movie->id, 'title' => 'Changed Title in DB']);
    }


    public function test_it_returns_correct_json_structure_after_updating_movie()
    {
        $movie = Movie::create([
            'title' => 'Original Movie for Structure Update',
            'duration_min' => 100,
            'description' => 'Description',
            'poster_url' => 'http://pelda-default-url.com/update_structure_poster.jpg',
            'type' => 'Action',
            'description' => 'Test Description',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $updatedData = [
            'title' => 'Updated Title Again',
            'type' => 'Action',
            'description' => 'Description',
            'duration_min' => 100,
            'poster_url' => 'http://pelda-default-url.com/update_structure_poster.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $response = $this->putJson("/api/movies/{$movie->id}", $updatedData);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'type',
                'description',
                'duration_min',
                'poster_url',
                'release_date',
                'director',
                'created_at',
                'updated_at',
            ]
        ]);
    }


    public function test_it_returns_updated_movie_data_after_updating_it()
    {
        $movie = Movie::create([
            'title' => 'Original Movie for Data Update',
            'duration_min' => 100,
            'type' => 'Action',
            'description' => 'Description',
            'poster_url' => 'http://pelda-default-url.com/update_data_poster.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $updatedData = [
            'title' => 'Finally Updated Data',
            'type' => 'Action',
            'duration_min' => 100,
            'description' => 'Description',
            'poster_url' => 'http://pelda-default-url.com/update_data_poster.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $response = $this->putJson("/api/movies/{$movie->id}", $updatedData);
        $response->assertJsonFragment(['title' => 'Finally Updated Data']);
    }


    public function test_it_returns_404_when_updating_a_non_existent_movie()
    {
        $updatedData = [
            'title' => 'Non Existent Update',
            'duration_min' => 100,
        ];
        $response = $this->putJson('/api/movies/9999', $updatedData);
        $response->assertStatus(404);
    }

    public function test_it_returns_successful_status_when_deleting_a_movie()
    {
        $movie = Movie::create([
            'title' => 'Movie to Delete',
            'type' => 'Action',
            'description' => 'Description',
            'duration_min' => 100,
            'poster_url' => 'http://pelda-default-url.com/delete_poster.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $response = $this->deleteJson("/api/movies/{$movie->id}");
        $response->assertStatus(204);
    }


    public function test_it_removes_movie_from_database_after_deleting_it()
    {
        $movie = Movie::create([
            'title' => 'Movie to be removed',
            'type' => 'Action',
            'description' => 'Description',
            'duration_min' => 100,
            'poster_url' => 'http://pelda-default-url.com/remove_poster.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
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
            'type' => 'Action',
            'duration_min' => 100,
            'poster_url' => 'http://pelda-default-url.com/validation_no_title.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $response = $this->postJson('/api/movies', $movieData);
        $response->assertStatus(422);
    }


    public function test_it_returns_422_when_creating_movie_with_too_long_title()
    {
        $movieData = [
            'title' => str_repeat('A', 256),
            'description' => 'Test description',
            'type' => 'Action',
            'duration_min' => 100,
            'poster_url' => 'http://pelda-default-url.com/validation_long_title.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $response = $this->postJson('/api/movies', $movieData);
        $response->assertStatus(422);
    }


    public function test_it_returns_422_when_creating_movie_with_negative_duration()
    {
        $movieData = [
            'title' => 'Valid Title',
            'description' => 'Test description',
            'type' => 'Action',
            'duration_min' => -10,
            'poster_url' => 'http://pelda-default-url.com/validation_negative_duration.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        $response = $this->postJson('/api/movies', $movieData);
        $response->assertStatus(422);
    }

    public function test_it_returns_422_when_updating_movie_with_too_long_title()
    {
        $movie = Movie::create([
            'title' => 'Original Movie',
            'description' => 'Test description',
            'duration_min' => 100,
            'type' => 'Action',
            'poster_url' => 'http://pelda-default-url.com/update_validation_long_title_original.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
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
            'description' => 'Test description',
            'duration_min' => 100,
            'type' => 'Action',
            'poster_url' => 'http://pelda-default-url.com/update_validation_negative_duration_original.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $updatedData = [
            'duration_min' => -5,
        ];
        $response = $this->putJson("/api/movies/{$movie->id}", $updatedData);
        $response->assertStatus(422);
    }


    public function test_it_returns_422_when_updating_movie_with_missing_title_but_not_required()
    {
        $movie = Movie::create([
            'title' => 'Original Movie',
            'duration_min' => 100,
            'description' => 'Test description',
            'type' => 'Action',
            'poster_url' => 'http://pelda-default-url.com/update_validation_missing_title_original.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $updatedData = [
            'title' => '',
        ];
        $response = $this->putJson("/api/movies/{$movie->id}", $updatedData);
        $response->assertStatus(422);
    }
}
