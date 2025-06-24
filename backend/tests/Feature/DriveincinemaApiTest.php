<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DriveincinemaApiTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_get_all_driveincinemas(): void
    {
        $response = $this->get('/api/driveincinemas');

        $response->assertStatus(200);
    }

    public function test_can_create_driveincinema() {

        $response = $this->postJson("/api/driveincinemas", [
            "name" => "TestName",
            "location" => "TestLocation",
            "description" => "TestDescription"
        ]);

        $response->assertStatus(201);
    }

    public function test_can_get_one_driveincinema() {

        $mockData = [
            "name" => "TestName",
            "location" => "TestLocation",
            "description" => "TestDescription"
        ];

        $mockDataresponse = $this->postJson('/api/driveincinemas', $mockData);
        $id = $mockDataresponse->json('data.id');

        $response = $this->getJson("/api/driveincinemas/$id");

        $response->assertStatus(200);
    }

    public function test_can_update_driveincinema() {

        $mockData = [
            "name" => "TestName",
            "location" => "TestLocation",
            "description" => "TestDescription"
        ];
        $mockDataresponse = $this->postJson('/api/driveincinemas', $mockData);
        $id = $mockDataresponse->json('data.id');


        $updateData = [
            "name" => "UpdatedTestName",
            "location" => "UpdatedTestLocation",
            "description" => "UpdatedTestDescription"
        ];

        $updateResponse = $this->putJson("/api/driveincinemas/{$id}", $updateData);
        $updateResponse->assertStatus(200);
    }

    public function test_can_delete_driveincinema() {

        $mockData = [
            "name" => "TestName",
            "location" => "TestLocation",
            "description" => "TestDescription"
        ];

        $mockDataResponse = $this->postJson('/api/driveincinemas', $mockData);
        $id = $mockDataResponse->json('data.id');

        $response = $this->deleteJson("/api/driveincinemas/{$id}");

        $response->assertStatus(204);
    }
}
