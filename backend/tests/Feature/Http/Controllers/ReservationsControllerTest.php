<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ReservationsControllerTest extends TestCase
{
    use DatabaseTransactions;
    public function test_can_get_reservations(): void
    {
        $response = $this->get('/api/reservations');

        $response->assertStatus(200);
    }

    public function test_can_post_reservation(): void
    {
        $response = $this->postJson('/api/reservations', [
            "user_id" => 1,
            "screening_id" => 10,
            "location_id" => 1,
            "reserved_at" => now()->toDateString(),
            "parkingspot" => "G8"
        ]);

        $response->assertStatus(201);
    }

    public function test_can_not_post_reservation_with_non_existent_user_id(): void
    {
        $response = $this->postJson('/api/reservations', [
            "user_id" => 999999999,
            "screening_id" => 10,
            "location_id" => 1,
            "reserved_at" => now()->toDateString(),
            "parkingspot" => "G8"
        ]);

        $response->assertStatus(422);
    }

    public function test_can_not_post_reservation_without_user_id(): void
    {
        $response = $this->postJson('/api/reservations', [
            "screening_id" => 10,
            "location_id" => 1,
            "reserved_at" => now()->toDateString(),
            "parkingspot" => "G8"
        ]);

        $response->assertStatus(422);
    }

    public function test_can_not_post_reservation_with_invalid_reserved_at_field(): void
    {
        $response = $this->postJson('/api/reservations', [
            "user_id" => 1,
            "screening_id" => 10,
            "location_id" => 1,
            "reserved_at" => "invalid_date_time",
            "parkingspot" => "G8"
        ]);

        $response->assertStatus(422);
    }

    public function test_can_not_book_another_reservation_to_the_same_parkingspot(): void
    {
        $this->postJson('/api/reservations', [
            "user_id" => 1,
            "screening_id" => 10,
            "location_id" => 1,
            "reserved_at" => now()->toDateString(),
            "parkingspot" => "G8"
        ]);

        $response = $this->postJson('/api/reservations', [
            "user_id" => 1,
            "screening_id" => 10,
            "location_id" => 1,
            "reserved_at" => now()->toDateString(),
            "parkingspot" => "G8"
        ]);

        $response->assertStatus(422);
    }

    public function test_reservation_json_structure_is_correct(): void
    {
        $response = $this->postJson('/api/reservations', [
            "user_id" => 1,
            "screening_id" => 10,
            "location_id" => 1,
            "reserved_at" => now()->toDateString(),
            "parkingspot" => "G8"
        ]);

        $response->assertJsonStructure([
            "data" => [
                "user_id",
                "screening_id",
                "location_id",
                "parkingspot",
                "reserved_at",
                "created_at"
            ]
        ]);
    }

    // $this->assertDatabaseHas('screenings', $screeningData);

    public function test_created_reservation_is_in_database(): void
    {
        $reservationData =  [
            "user_id" => 1,
            "screening_id" => 10,
            "location_id" => 1,
            "reserved_at" => now()->toDateString(),
            "parkingspot" => "G8"
        ];

        $this->postJson("/api/reservations", $reservationData);
        $this->assertDatabaseHas("reservations", $reservationData);
    }
}
