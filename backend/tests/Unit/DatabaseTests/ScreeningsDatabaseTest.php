<?php

namespace Tests\Feature;

use App\Models\DriveInCinema;
use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ScreeningsDatabaseTest extends TestCase
{
    use DatabaseTransactions;

    public function test_screenings_table_exists()
    {
        $this->assertTrue(Schema::hasTable('screenings'));
    }

    public function test_screenings_table_has_expected_columns()
    {
        $expected = [
            'id',
            'movie_id',
            'DriveInCinema_id',
            'start_time',
        ];

        foreach ($expected as $column) {
            $this->assertTrue(
                Schema::hasColumn('screenings', $column),
                "Missing column: {$column}"
            );
        }
    }
    
    public function test_screening_is_saved_to_database()
    {
        $movie = new Movie([
            "title" => "TestTitle",
            "description" => "TestDescription",
            "duration_min" => 90,
            "posterUrl" => "TestPosterUrl"
        ]);

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

    public function test_screening_can_be_deleted()
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

    public function test_screening_all_fields_not_null()
    {
        $screening = new Screening([
            'movie_id' => $movie->id,
            'DriveInCinema_id' => $cinema->id,
            'start_time' => '2025-06-24 20:00:00',
        ]);

        $this->assertNotNull($screening->movie_id);
        $this->assertNotNull($screening->DriveInCinema_id);
        $this->assertNotNull($screening->start_time);
    }
}
