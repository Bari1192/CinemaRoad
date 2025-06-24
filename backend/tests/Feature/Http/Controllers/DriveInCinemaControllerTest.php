<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DriveInCinemaControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_get_all_DriveInCinemas(): void
    {
        $response = $this->get('/api/drive_in_cinemas');

        $response->assertStatus(200);
    }

    public function test_can_create_DriveInCinema() {

        $response = $this->postJson("/api/drive_in_cinemas", [
            "name" => "TestName",
            "location" => "TestLocation",
            "description" => "TestDescription"
        ]);

        $response->assertStatus(201);
    }

    public function test_can_get_one_DriveInCinema() {

        $mockData = [
            "name" => "TestName",
            "location" => "TestLocation",
            "description" => "TestDescription"
        ];

        $mockDataresponse = $this->postJson('/api/drive_in_cinemas', $mockData);
        $id = $mockDataresponse->json('data.id');

        $response = $this->getJson("/api/drive_in_cinemas/$id");

        $response->assertStatus(200);
    }

    public function test_can_update_DriveInCinema() {

        $mockData = [
            "name" => "TestName",
            "location" => "TestLocation",
            "description" => "TestDescription"
        ];
        $mockDataresponse = $this->postJson('/api/drive_in_cinemas', $mockData);
        $id = $mockDataresponse->json('data.id');


        $updateData = [
            "name" => "UpdatedTestName",
            "location" => "UpdatedTestLocation",
            "description" => "UpdatedTestDescription"
        ];

        $updateResponse = $this->putJson("/api/drive_in_cinemas/{$id}", $updateData);
        $updateResponse->assertStatus(200);
    }

    public function test_can_delete_DriveInCinema() {

        $mockData = [
            "name" => "TestName",
            "location" => "TestLocation",
            "description" => "TestDescription"
        ];

        $mockDataResponse = $this->postJson('/api/drive_in_cinemas', $mockData);
        $id = $mockDataResponse->json('data.id');

        $response = $this->deleteJson("/api/drive_in_cinemas/{$id}");

        $response->assertStatus(204);
    }
}
