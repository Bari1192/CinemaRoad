<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PurchaseControllerTest extends TestCase
{
    use DatabaseTransactions;
    public function test_can_get_purchases(): void
    {
        $response = $this->get('/api/purchases');

        $response->assertStatus(200);
    }

    // U S E R
    public function test_user_can_post_purchase()
    {
        $response = $this->postJson("/api/purchases", [
            "location_id" => 1,
            "movie_id" => 1,
            "screening_id" => 1,
            "parkingspot" => "A1",
            "user_id" => 1,
        ]);

        $response->assertStatus(201);
    }

    public function test_user_purchase_is_in_database()
    {
        $purchaseData = [
            "location_id" => 1,
            "movie_id" => 1,
            "screening_id" => 1,
            "parkingspot" => "A1",
            "user_id" => 1,
        ];

        $this->postJson("/api/purchases", $purchaseData);
        $this->assertDatabaseHas(
            "purchases",
            [
                "location_id" => 1,
                "movie_id" => 1,
                "screening_id" => 1,
                "parkingspot" => "A1",
                "user_id" => 1
            ]
        );
    }

    public function test_user_purchase_json_structure_correct()
    {
        $purchaseData = [
            "location_id" => 1,
            "movie_id" => 1,
            "screening_id" => 1,
            "parkingspot" => "A1",
            "user_id" => 1,
        ];

        $response = $this->postJson("/api/purchases", $purchaseData);
        $response->assertJsonStructure([
            "data" =>
            [
                "id",
                "location_id",
                "screening_id",
                "movie_id",
                "ticket_code",
                "guest_email",
                "parkingspot",
                "created_at",
                "updated_at"
            ]
        ]);
    }

    // G U E S T
    public function test_guest_can_post_purchase()
    {
        $response = $this->postJson("/api/purchases", [
            "location_id" => 1,
            "movie_id" => 1,
            "screening_id" => 1,
            "parkingspot" => "A1",
            "guest_email" => "guestTestEmail@gmail.com"
        ]);

        $response->assertStatus(201);
    }

    public function test_guest_purchase_is_in_database()
    {
        $purchaseData = [
            "location_id" => 1,
            "movie_id" => 1,
            "screening_id" => 1,
            "parkingspot" => "A1",
            "guest_email" => "guestTestEmail@gmail.com",
        ];

        $this->postJson("/api/purchases", $purchaseData);
        $this->assertDatabaseHas(
            "purchases",
            [
                "location_id" => 1,
                "movie_id" => 1,
                "screening_id" => 1,
                "parkingspot" => "A1",
                "guest_email" => "guestTestEmail@gmail.com",
            ]
        );
    }

    public function test_guest_purchase_json_structure_correct()
    {
        $purchaseData = [
            "location_id" => 1,
            "movie_id" => 1,
            "screening_id" => 1,
            "parkingspot" => "A1",
            "user_id" => 1,
        ];

        $response = $this->postJson("/api/purchases", $purchaseData);
        $response->assertJsonStructure([
            "data" =>
            [
                "id",
                "location_id",
                "screening_id",
                "movie_id",
                "ticket_code",
                "guest_email",
                "parkingspot",
                "created_at",
                "updated_at"
            ]
        ]);
    }
}
