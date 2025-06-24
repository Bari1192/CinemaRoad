<?php

namespace Tests\Unit\Models;

use App\Models\DriveInCinema;
use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\TestCase;

class MovieRelationshipTest extends TestCase
{
    use DatabaseTransactions;

    public function test_a_movie_can_have_multiple_screenings()
    {

        $movie = Movie::create([
            'title' => 'Test Movie for Screenings',
            'duration_min' => 90,
        ]);
        $cinema = DriveInCinema::create([
            'name' => 'Teszt Mozi Helyszín',
            'location' => 'Valahol utca 1.',
            'description' => 'A teszt mozi leírása.',
        ]);
        $screening1 = Screening::create([
            'movie_id' => $movie->id,
            'drive_in_cinema_id' => $cinema->id, 
            'start_time' => "2025-06-24 18:00:00",
            'end_time' => "2025-06-24 20:00:00",
        ]);
        $screening2 = Screening::create([
            'movie_id' => $movie->id,
            'drive_in_cinema_id' => $cinema->id,
            'start_time' => "2025-06-25 10:00:00",
            'end_time' => "2025-06-25 12:00:00",
        ]);

        $this->assertTrue($movie->screenings->contains($screening1));
    }

    public function test_movie_screenings_collection_is_countable()
    {
        $movie = Movie::create([
            'title' => 'Countable Movie',
            'duration_min' => 100,
        ]);

        $cinema = DriveInCinema::create([
            'name' => 'Countable Cinema',
            'location' => 'Countable Location',
            'description' => 'Countable Description',
        ]);

        Screening::create([
            'movie_id' => $movie->id,
            'drive_in_cinema_id' => $cinema->id,
            'start_time' => "2025-07-01 19:00:00",
            'end_time' => "2025-07-01 21:00:00",
        ]);

        Screening::create([
            'movie_id' => $movie->id,
            'drive_in_cinema_id' => $cinema->id,
            'start_time' => "2025-07-02 20:00:00",
            'end_time' => "2025-07-02 22:00:00",
        ]);

        $this->assertCount(2, $movie->screenings);
    }

    public function test_screening_belongs_to_a_single_movie()
    {

        $movie = Movie::create([
            'title' => 'Belongs To Test Movie',
            'duration_min' => 110,
        ]);

        $cinema = DriveInCinema::create([
            'name' => 'Belongs To Cinema',
            'location' => 'Belongs To Location',
            'description' => 'Belongs To Description',
        ]);

        $screening = Screening::create([
            'movie_id' => $movie->id,
            'drive_in_cinema_id' => $cinema->id,
            'start_time' => "2025-06-26 15:00:00",
            'end_time' => "2025-06-26 17:00:00",
        ]);

        $this->assertEquals($movie->id, $screening->movie->id);
    }

    public function test_a_screening_movie_relation_returns_movie_instance()
    {
        $movie = Movie::create([
            'title' => 'Instance Test Movie',
            'duration_min' => 130,
        ]);
        $cinema = DriveInCinema::create([
            'name' => 'Instance Test Cinema',
            'location' => 'Instance Test Location',
            'description' => 'Instance Test Description',
        ]);
        $screening = Screening::create([
            'movie_id' => $movie->id,
            'drive_in_cinema_id' => $cinema->id,
            'start_time' => "2025-06-27 11:00:00",
            'end_time' => "2025-06-27 13:00:00",
        ]);
        $this->assertInstanceOf(Movie::class, $screening->movie);
    }
}
