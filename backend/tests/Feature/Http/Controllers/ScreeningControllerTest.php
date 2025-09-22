<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\DriveInCinema;
use App\Models\Movie;
use App\Models\Screening;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ScreeningControllerTest extends TestCase
{
    use DatabaseTransactions;
    protected Movie $movie;
    protected DriveInCinema $cinema;
    protected function setUp(): void
    {
        parent::setUp();
        $this->movie = Movie::create([
            'title' => 'Test Movie for Screening',
            'duration_min' => 120,
            'poster_url' => 'http://test.url/poster_movie.jpg',
            'type' => 'Action',
            'description' => 'Description',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $this->cinema = DriveInCinema::create([
            'name' => 'Test Drive-In Cinema for Screening',
            'location' => 'Test Location',
            'description' => 'Test Description',
        ]);
    }

    public function test_it_returns_successful_response_for_getting_all_screenings()
    {
        $response = $this->getJson('/api/screenings');
        $response->assertStatus(200);
    }

    public function test_it_returns_data_key_when_getting_all_screenings()
    {
        Screening::create([
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-24 10:00:00',
        ]);
        $response = $this->getJson('/api/screenings');
        $response->assertJsonStructure(['data']);
    }

    public function test_it_returns_non_empty_data_array_when_getting_all_screenings()
    {
        Screening::create([
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-24 11:00:00',
        ]);
        $response = $this->getJson('/api/screenings');
        $this->assertNotEmpty($response->json('data'));
    }

    public function test_it_returns_201_when_creating_a_screening()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($admin, 'sanctum');

        $screeningData = [
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-24 18:00:00',
        ];
        $response = $this->postJson('/api/screenings', $screeningData);
        $response->assertStatus(201);
    }

    public function test_it_stores_screening_in_database_when_creating_it()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($admin, 'sanctum');
        
        $screeningData = [
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-24 18:00:00',
        ];
        $this->postJson('/api/screenings', $screeningData);
        $this->assertDatabaseHas('screenings', $screeningData);
    }

    public function test_it_returns_correct_json_structure_after_creating_screening()
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($admin, 'sanctum');
        
        $screeningData = [
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-24 18:00:00',
        ];
        $response = $this->postJson('/api/screenings', $screeningData);
        $response->assertJsonStructure(['data' => ['id', 'movie_id', 'drive_in_cinema_id', 'start_time']]);
    }

    public function test_it_returns_200_when_getting_one_screening()
    {
        $screening = Screening::create([
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-23 16:00:00',
        ]);
        $response = $this->getJson("/api/screenings/{$screening->id}");
        $response->assertStatus(200);
    }

    public function test_it_returns_correct_screening_data_when_getting_one_screening()
    {
        $screening = Screening::create([
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-23 16:00:00',
        ]);
        $response = $this->getJson("/api/screenings/{$screening->id}");
        $response->assertJsonFragment(['start_time' => '2025-06-23 16:00:00']);
    }

    public function test_it_returns_404_when_getting_non_existent_screening()
    {
        $response = $this->getJson('/api/screenings/9999');
        $response->assertStatus(404);
    }

    public function test_it_returns_200_when_updating_screening()
    {
        $screening = Screening::create([
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-23 16:00:00',
        ]);
        $updateData = [
            'start_time' => '2025-06-23 17:00:00',
        ];
        $response = $this->putJson("/api/screenings/{$screening->id}", $updateData);
        $response->assertStatus(200);
    }

    public function test_it_updates_screening_data_in_database()
    {
        $screening = Screening::create([
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-23 16:00:00',
        ]);
        $updateData = [
            'start_time' => '2025-06-23 17:00:00',
        ];
        $this->putJson("/api/screenings/{$screening->id}", $updateData);
        $this->assertDatabaseHas('screenings', ['id' => $screening->id, 'start_time' => '2025-06-23 17:00:00']);
    }

    public function test_it_returns_404_when_updating_non_existent_screening()
    {
        $updateData = [
            'start_time' => '2025-06-23 17:00:00',
        ];
        $response = $this->putJson('/api/screenings/9999', $updateData);
        $response->assertStatus(404);
    }

    public function test_it_returns_204_when_deleting_screening()
    {
        $screening = Screening::create([
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-23 16:00:00',
        ]);
        $response = $this->deleteJson("/api/screenings/{$screening->id}");
        $response->assertStatus(204);
    }

    public function test_it_removes_screening_from_database_after_deleting_it()
    {
        $screening = Screening::create([
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-23 16:00:00',
        ]);
        $this->deleteJson("/api/screenings/{$screening->id}");
        $this->assertDatabaseMissing('screenings', ['id' => $screening->id]);
    }

    public function test_it_returns_404_when_deleting_non_existent_screening()
    {
        $response = $this->deleteJson('/api/screenings/9999');
        $response->assertStatus(404);
    }
}
