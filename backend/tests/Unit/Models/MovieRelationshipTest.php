<?php

namespace Tests\Unit\Models;

use App\Models\DriveInCinema;
use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MovieRelationshipTest extends TestCase
{
    use DatabaseTransactions;

    protected Movie $movie;
    protected DriveInCinema $cinema;
    protected Screening $screening; // initial screening
    protected Movie $anotherMovie; // newly added movie for another screening
    protected Screening $anotherScreeningForCinema; // newly added screening for the cinema

    protected function setUp(): void
    {
        parent::setUp();

        // 1. Létrehozzuk az alap film (movie) és mozi (cinema) objektumokat
        $this->movie = Movie::create([
            'title' => 'Test Movie for Relationship',
            'description' => 'A description for the test movie.',
            'duration_min' => 100,
            'poster_url' => 'http://example.com/test_movie_poster.jpg',
        ]);

        $this->cinema = DriveInCinema::create([
            'name' => 'Test Cinema for Relationship',
            'location' => 'Test Location for Relations',
            'description' => 'Description of the test cinema.',
        ]);

        // 2. Létrehozzuk az első vetítést (screening), ami ehhez a filmhez és mozihoz tartozik
        $this->screening = Screening::create([
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-24 18:00:00',
        ]);

        // 3. Létrehozunk egy második filmet és egy második vetítést,
        // ami szintén az $this->cinema-hoz tartozik
        $this->anotherMovie = Movie::create([
            'title' => 'Another movie for cinema',
            'description' => 'Another description for the test movie.',
            'duration_min' => 80,
            'poster_url' => 'http://example.com/another_test_movie_poster.jpg',
        ]);

        $this->anotherScreeningForCinema = Screening::create([
            'movie_id' => $this->anotherMovie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-26 10:00:00',
        ]);

        // Fontos: Frissítjük a $this->cinema objektumot, hogy a 'screenings' kollekciója friss legyen.
        // Ha ezt kihagyjuk, a kollekció nem fogja tartalmazni az "anotherScreeningForCinema"-t.
        $this->cinema = $this->cinema->fresh();
        // VAGY: $this->cinema->load('screenings');
    }

    // Eredeti tesztek, amik a film és vetítés kapcsolatára fókuszálnak
    public function test_test_a_movie_can_have_multiple_screenings()
    {
        // Itt már tudjuk, hogy a setUp() által létrehozott filmhez tartozik legalább egy screening
        $this->assertTrue($this->movie->screenings->contains($this->screening->fresh())); // fresh() a megbízható összehasonlításhoz
    }

    public function test_test_movie_screenings_collection_is_countable()
    {
        // A setUp() már létrehozott két vetítést a cinema-hoz, de a movie-hoz csak egyet.
        // Ha azt akarjuk tesztelni, hogy a MOVIE-hoz hány screening tartozik, akkor ahhoz a movie-hoz kell újat létrehozni.
        // Ha ez a teszt azt hivatott ellenőrizni, hogy egy mozi (movie) hány vetítéssel rendelkezik összesen (az adott movie-hoz)
        // akkor létre kell hozni még egy screeninget az $this->movie-hoz.
        Screening::create([
            'movie_id' => $this->movie->id, // Ugyanaz a film
            'drive_in_cinema_id' => $this->cinema->id, // Ugyanaz a mozi
            'start_time' => "2025-06-25 10:00:00",
        ]);
        // Frissítjük a filmet is, hogy a screenings kollekciója friss legyen
        $this->movie = $this->movie->fresh();
        $this->assertCount(2, $this->movie->screenings);
    }

    public function test_test_screening_belongs_to_a_single_movie()
    {
        // A $this->screening a setUp()-ban jön létre, movie_id-val
        $this->assertEquals($this->movie->id, $this->screening->movie->id);
    }

    public function test_test_a_screening_movie_relation_returns_movie_instance()
    {
        $this->assertInstanceOf(Movie::class, $this->screening->movie);
    }

    // --- Szétbontott tesztek a drive-in cinema és screening kapcsolatáról ---

    
    public function test_drive_in_cinema_screenings_collection_contains_initial_screening()
    {
        // A cinema objektum már frissítve lett a setUp()-ban
        $this->assertTrue($this->cinema->screenings->contains($this->screening->fresh()), 'The cinema should contain the initial screening.');
    }

    
    public function test_drive_in_cinema_screenings_collection_contains_additional_screening()
    {
        // A cinema objektum már frissítve lett a setUp()-ban
        $this->assertTrue($this->cinema->screenings->contains($this->anotherScreeningForCinema->fresh()), 'The cinema should contain the additional screening.');
    }

    
    public function test_drive_in_cinema_screenings_collection_has_correct_count()
    {
        // A setUp() két vetítést hozott létre a $this->cinema-hoz.
        // A cinema objektum már frissítve lett a setUp()-ban.
        $this->assertCount(2, $this->cinema->screenings, 'The cinema should have exactly two screenings.');
    }

    
    public function test_drive_in_cinema_has_many_screenings_relationship_type_is_correct()
    {
        // Ez a teszt ellenőrzi a kapcsolat típusát, ami jó gyakorlat.
        $relation = $this->cinema->screenings();
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $relation);
    }
}