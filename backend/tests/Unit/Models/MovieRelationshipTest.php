<?php

namespace Tests\Unit\Models;

use App\Models\DriveInCinema;
use App\Models\Movie;
use App\Models\Screening;
use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MovieRelationshipTest extends TestCase
{
    use DatabaseTransactions;

    protected Movie $movie;
    protected DriveInCinema $cinema;
    protected Screening $screening;
    protected Movie $anotherMovie;
    protected Screening $anotherScreeningForCinema;

    protected function setUp(): void
    {
        parent::setUp();

        $this->movie = Movie::create([
            'title' => 'Test Movie for Relationship',
            'type' => 'Action',
            'description' => 'A description for the test movie.',
            'duration_min' => 100,
            'poster_url' => 'http://example.com/test_movie_poster.jpg',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->cinema = DriveInCinema::create([
            'name' => 'Test Cinema for Relationship',
            'location' => 'Test Location for Relations',
            'description' => 'Description of the test cinema.',
        ]);

        $this->screening = Screening::create([
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-24 18:00:00',
        ]);

        $this->anotherMovie = Movie::create([
            'title' => 'Another movie for cinema',
            'type' => 'Action',
            'description' => 'Another description for the test movie.',
            'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
            'director' => fake()->firstName() . ' ' . fake()->lastName(),
            'duration_min' => 80,
            'poster_url' => 'http://example.com/another_test_movie_poster.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->anotherScreeningForCinema = Screening::create([
            'movie_id' => $this->anotherMovie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-26 10:00:00',
        ]);

        $this->cinema = $this->cinema->fresh();
    }

    public function test_test_a_movie_can_have_multiple_screenings()
    {
        $this->assertTrue($this->movie->screenings->contains($this->screening->fresh()));
    }

    public function test_test_movie_screenings_collection_is_countable()
    {
        Screening::create([
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => "2025-06-25 10:00:00",
        ]);
        $this->movie = $this->movie->fresh();
        $this->assertCount(2, $this->movie->screenings);
    }

    public function test_test_screening_belongs_to_a_single_movie()
    {
        $this->assertEquals($this->movie->id, $this->screening->movie->id);
    }

    public function test_test_a_screening_movie_relation_returns_movie_instance()
    {
        $this->assertInstanceOf(Movie::class, $this->screening->movie);
    }



    public function test_drive_in_cinema_screenings_collection_contains_initial_screening()
    {
        $this->assertTrue($this->cinema->screenings->contains($this->screening->fresh()), 'The cinema should contain the initial screening.');
    }


    public function test_drive_in_cinema_screenings_collection_contains_additional_screening()
    {
        $this->assertTrue($this->cinema->screenings->contains($this->anotherScreeningForCinema->fresh()), 'The cinema should contain the additional screening.');
    }


    public function test_drive_in_cinema_screenings_collection_has_correct_count()
    {
        $this->assertCount(2, $this->cinema->screenings, 'The cinema should have exactly two screenings.');
    }


    public function test_drive_in_cinema_has_many_screenings_relationship_type_is_correct()
    {
        $relation = $this->cinema->screenings();
        $this->assertInstanceOf(HasMany::class, $relation);
    }
}
