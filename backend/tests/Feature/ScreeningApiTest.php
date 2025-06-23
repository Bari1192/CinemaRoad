<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ScreeningApiTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     */
    public function test_can_get_all_screening(): void
    {
        $response = $this->get('/api/screenings');

        $response->assertStatus(200);
    }

    public function test_can_create_screening() {

        $response = $this->postJson("/api/screenings", [
            'movie_id' => 2,
            'driveincinema_id' => 2,
            'start_time' => "2025-06-24 18:00:00"
        ]);

        $response->assertStatus(201);
    }

    public function test_can_get_one_screening() {

        $mockData = [
            "movie_id" => 2,
            "driveincinema_id" => 2,
            "start_time" => "2025-06-23 16:00:00",
        ];
        $mockDataresponse = $this->postJson('/api/screenings', $mockData);
        $id = $mockDataresponse->json('data.id');

        $response = $this->getJson("/api/screenings/$id");

        $response->assertStatus(200);
    }

    public function test_can_update_screening() {

        $mockData = [
            "movie_id" => 2,
            "driveincinema_id" => 2,
            "start_time" => "2025-06-23 16:00:00",
        ];
        $mockDataresponse = $this->postJson('/api/screenings', $mockData);
        $id = $mockDataresponse->json('data.id');


        $updateData = [
            "movie_id" => 2,
            "driveincinema_id" => 2,
            "start_time" => "2025-06-23 17:00:00"
        ];

        $updateResponse = $this->putJson("/api/screenings/{$id}", $updateData);
        $updateResponse->assertStatus(200);
    }

    public function test_can_delete_screening() {

        $mockData = [
            "movie_id" => 2,
            "driveincinema_id" => 2,
            "start_time" => "2025-06-23 16:00:00",
        ];
        $mockDataResponse = $this->postJson('/api/screenings', $mockData);
        $id = $mockDataResponse->json('data.id');

        $response = $this->deleteJson("/api/screenings/{$id}");

        $response->assertStatus(204);
    }
}
