<?php

namespace Tests\Unit;

use App\Models\Driveincinema;
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
            "driveincinema_id" => 2,
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
            "driveincinema_id" => 2,
            "start_time" => "2025-06-23 16:00:00"
        ]);

        $this->assertInstanceOf(Movie::class, $screening->movie);
        $this->assertEquals($movie->id, $screening->movie->id);
    }

    public function test_screening_belongs_to_drivein_cinema()
    {
        $cinema = new DriveinCinema([
            "name" => "TestDriveinCinemaName",
            "location" => "TestDriveinCinemaLocation",
            "description" => "TestDriveinCinemaDescription"
        ]);

        $screening = new Screening([
            "movie_id" => 2,
            "driveincinema_id" => 2,
            "start_time" => "2025-06-23 16:00:00"
        ]);

        $this->assertInstanceOf(Driveincinema::class, $screening->driveinCinema);
        $this->assertEquals($cinema->id, $screening->driveinCinema->id);
    }
}
