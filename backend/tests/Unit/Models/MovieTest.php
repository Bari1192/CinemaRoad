<?php

namespace Tests\Unit\Models;

use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use DatabaseTransactions;

    public function it_uses_the_correct_table_name(): void
    {
        $movie = new Movie;

        $this->assertSame('movies', $movie->getTable());
    }
    public function it_has_fillable_attributes(): void
    {
        $movie = new Movie;

        $this->assertEquals(
            ['title', 'description', 'duration_min', 'poster_url'],
            $movie->getFillable()
        );
    }
    public function test_a_movie_has_many_screenings()
    {
        $movie = Movie::create([
            'title' => 'Test Movie for Screenings',
            'type' => 'Test_movie_type',
            'description' => 'Test_movie_description',
            'duration_min' => 90,
            'poster_url' => 'N/A_test_poster_url/poster_url'
        ]);

        $screening = Screening::create([
            'movie_id' => $movie->id,
            'drive_in_cinema_id' => 1,
            'start_time' => now(),
        ]);
        $movie->refresh();

        $this->assertTrue($movie->screenings->contains($screening));
    }

    public function test_a_screening_belongs_to_a_movie()
    {
        $movie = Movie::create([
            'title' => 'Parent Movie',
            'duration_min' => 120,
        ]);
        $screening = Screening::create([
            'movie_id' => $movie->id,
            'drive_in_cinema_id' => 1,
            'start_time' => "2025-06-25 10:00:00",
        ]);
        $this->assertEquals($movie->id, $screening->movie->id);
    }
}
