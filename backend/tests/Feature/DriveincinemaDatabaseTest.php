<?php

namespace Tests\Feature;

use App\Models\Driveincinema;
use App\Models\Screening;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DriveincinemaDatabaseTest extends TestCase
{
    public function test_driveincinemas_table_exists()
    {
        $this->assertTrue(Schema::hasTable('driveincinemas'));
    }

    public function test_driveincinemas_table_has_expected_columns()
    {
        $expected = [
            'name',
            'location',
            'description',
        ];

        foreach ($expected as $column) {
            $this->assertTrue(
                Schema::hasColumn('driveincinemas', $column),
                "Missing column: {$column}"
            );
        }
    }

    public function test_driveincinema_is_saved_to_database()
    {
        $cinema = new Driveincinema([
            "name" => "TestName",
            "location" => "TestLocation",
            "description" => "TestDescription"
        ]);

        $screening = new Screening([
            'movie_id' => $movie->id,
            'driveincinema_id' => $cinema->id,
            'start_time' => '2025-06-24 20:00:00',
        ]);

        $this->assertDatabaseHas('screenings', [
            'movie_id' => $movie->id,
            'driveincinema_id' => $cinema->id,
            'start_time' => '2025-06-24 20:00:00',
        ]);
    }

    public function test_driveincinema_can_be_deleted()
    {
        $screening = new Screening([
            'movie_id' => $movie->id,
            'driveincinema_id' => $cinema->id,
            'start_time' => '2025-06-24 20:00:00',
        ]);

        $screening->delete();

        $this->assertDatabaseMissing('screenings', [
            'id' => $screening->id
        ]);
    }

    public function test_driveincinemas_all_fields_not_null()
    {
        $driveinCinema = new Driveincinema([
            "name" => "TestName",
            "location" => "TestLocation",
            "description" => "TestDescription"
        ]);

        $this->assertNotNull($driveinCinema->name);
        $this->assertNotNull($driveinCinema->location);
        $this->assertNotNull($driveinCinema->description);
    }
}
