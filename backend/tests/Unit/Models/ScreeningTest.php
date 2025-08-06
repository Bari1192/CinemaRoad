<?php

namespace Tests\Unit\Models;

use App\Models\DriveInCinema;
use App\Models\Movie;
use App\Models\Screening;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ScreeningTest extends TestCase
{
    use DatabaseTransactions;

    public function test_screening_has_correct_start_time()
    {
        $mockScreening = new Screening([
            "movie_id" => 2,
            "drive_in_cinema_id" => 2,
            "start_time" => "2025-06-23 16:00:00"
        ]);
        $this->assertEquals('2025-06-23 16:00:00', $mockScreening->start_time);
    }

    public function test_screening_belongs_to_movie()
    {
        $movie = new Movie([
            "title" => "TestMovieTitle",
            "description" => "TestMovieDescription",
            "duration_min" => 120,
            "poster_url" => "http://test.url/movie_poster.jpg",
            'description' => 'Description',
            'type' => 'Action',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $movie->save();
        $cinema = new DriveInCinema([
            "name" => "TestCinema",
            "location" => "TestLocation",
            "description" => "TestDescription"
        ]);

        $cinema->save();
        $screening = new Screening([
            "movie_id" => $movie->id,
            "drive_in_cinema_id" => $cinema->id,
            "start_time" => "2025-06-23 16:00:00"
        ]);
        $screening->save();
        $retrievedScreening = Screening::find($screening->id);
        $this->assertEquals($movie->id, $retrievedScreening->movie->id);
    }

    public function test_screening_belongs_to_drivein_cinema()
    {
        $movie = new Movie([
            "title" => "TestMovieTitle2",
            "description" => "TestMovieDescription2",
            "duration_min" => 100,
            "poster_url" => "http://test.url/movie_poster2.jpg",
            'description' => 'Description',
            'type' => 'Action',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $movie->save();
        $cinema = new DriveInCinema([
            "name" => "TestCinema2",
            "location" => "TestLocation2",
            "description" => "TestDescription2"
        ]);

        $cinema->save();
        $screening = new Screening([
            "movie_id" => $movie->id,
            "drive_in_cinema_id" => $cinema->id,
            "start_time" => "2025-06-24 18:00:00"
        ]);
        $screening->save();
        $retrievedScreening = Screening::find($screening->id);
        $this->assertEquals($cinema->id, $retrievedScreening->driveInCinema->id);
    }
}
