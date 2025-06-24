<?php

namespace Tests\Unit;

use App\Models\DriveInCinema;
use App\Models\Screening;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\TestCase;

class ScreeningTest extends TestCase
{
    use DatabaseTransactions;
    
    public function test_screening_has_correct_start_time()
    {
        $mockScreening = new Screening([
            "movie_id" => 2,
            "DriveInCinema_id" => 2,
            "start_time" => "2025-06-23 16:00:00"
        ]);

        $this->assertEquals('2025-06-23 16:00:00', $mockScreening->start_time);
    }

    public function test_screening_belongs_to_movie() {

        $movie = new Movie([
            "title" => "TestTitle",
            "description" => "TestDescription",
            "duration_min" => 90,
            "posterUrl" => "posterUrl"
        ]);

        $screening = new Screening([
            "movie_id" => 2,
            "DriveInCinema_id" => 2,
            "start_time" => "2025-06-23 16:00:00"
        ]);

        $this->assertInstanceOf(Movie::class, $screening->movie);
        $this->assertEquals($movie->id, $screening->movie->id);
    }

    public function test_screening_belongs_to_drivein_cinema()
    {
        $cinema = new DriveInCinema([
            "name" => "TestDriveInCinemaName",
            "location" => "TestDriveInCinemaLocation",
            "description" => "TestDriveInCinemaDescription"
        ]);

        $screening = new Screening([
            "movie_id" => 2,
            "DriveInCinema_id" => 2,
            "start_time" => "2025-06-23 16:00:00"
        ]);

        $this->assertInstanceOf(DriveInCinema::class, $screening->DriveInCinema);
        $this->assertEquals($cinema->id, $screening->DriveInCinema->id);
    }
}
