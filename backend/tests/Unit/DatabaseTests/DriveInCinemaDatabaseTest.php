<?php

namespace Tests\Unit\DatabaseTests;

use App\Models\DriveInCinema;
use App\Models\Screening;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DriveInCinemaDatabaseTest extends TestCase
{
    public function test_DriveInCinemas_table_exists()
    {
        $this->assertTrue(Schema::hasTable('DriveInCinemas'));
    }

    public function test_DriveInCinemas_table_has_expected_columns()
    {
        $expected = [
            'name',
            'location',
            'description',
        ];

        foreach ($expected as $column) {
            $this->assertTrue(
                Schema::hasColumn('DriveInCinemas', $column),
                "Missing column: {$column}"
            );
        }
    }

    public function test_DriveInCinema_is_saved_to_database()
    {
        $cinema = new DriveInCinema([
            "name" => "TestName",
            "location" => "TestLocation",
            "description" => "TestDescription"
        ]);

        $screening = new Screening([
            'movie_id' => $movie->id,
            'DriveInCinema_id' => $cinema->id,
            'start_time' => '2025-06-24 20:00:00',
        ]);

        $this->assertDatabaseHas('screenings', [
            'movie_id' => $movie->id,
            'DriveInCinema_id' => $cinema->id,
            'start_time' => '2025-06-24 20:00:00',
        ]);
    }

    public function test_DriveInCinema_can_be_deleted()
    {
        $screening = new Screening([
            'movie_id' => $movie->id,
            'DriveInCinema_id' => $cinema->id,
            'start_time' => '2025-06-24 20:00:00',
        ]);

        $screening->delete();

        $this->assertDatabaseMissing('screenings', [
            'id' => $screening->id
        ]);
    }

    public function test_DriveInCinemas_all_fields_not_null()
    {
        $DriveInCinema = new DriveInCinema([
            "name" => "TestName",
            "location" => "TestLocation",
            "description" => "TestDescription"
        ]);

        $this->assertNotNull($DriveInCinema->name);
        $this->assertNotNull($DriveInCinema->location);
        $this->assertNotNull($DriveInCinema->description);
    }
}
