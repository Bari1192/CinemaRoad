<?php

namespace Tests\Unit\DatabaseTests;

use App\Models\DriveInCinema;
use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ScreeningsDatabaseTest extends TestCase
{
    use DatabaseTransactions;

    // Ezeket a változókat a setUp metódusban inicializáljuk
    protected Movie $movie;
    protected DriveInCinema $cinema;
    protected Screening $screening;

    protected function setUp(): void
    {
        parent::setUp();

        $this->movie = Movie::create([
            "title" => "TestTitle For Screening",
            "description" => "TestDescription For Screening",
            "duration_min" => 90,
            "poster_url" => "http://test-poster.url/poster.jpg" 
        ]);

        $this->cinema = DriveInCinema::create([
            "name" => "TestName For Screening Cinema",
            "location" => "TestLocation For Screening Cinema",
            "description" => "TestDescription For Screening Cinema"
        ]);

        $this->screening = Screening::create([
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-24 20:00:00',
        ]);
    }
    
    public function test_screenings_table_exists()
    {
        $this->assertTrue(
            Schema::hasTable('screenings'),
            'A `screenings` tábla nem jött létre az adatbázisban.'
        );
    }

    public function test_screenings_table_has_id_column()
    {
        $this->assertTrue(
            Schema::hasColumn('screenings', 'id'),
            'A `screenings` táblában nincs `id` oszlop.'
        );
    }

    
    public function test_screenings_table_has_movie_id_column()
    {
        $this->assertTrue(
            Schema::hasColumn('screenings', 'movie_id'),
            'A `screenings` táblában nincs `movie_id` oszlop.'
        );
    }

    
    public function test_screenings_table_has_drive_in_cinema_id_column()
    {
        $this->assertTrue(
            Schema::hasColumn('screenings', 'drive_in_cinema_id'),
            'A `screenings` táblában nincs `drive_in_cinema_id` oszlop.'
        );
    }

    
    public function test_screenings_table_has_start_time_column()
    {
        $this->assertTrue(
            Schema::hasColumn('screenings', 'start_time'),
            'A `screenings` táblában nincs `start_time` oszlop.'
        );
    }

    public function test_screening_id_column_is_bigint()
    {
        $this->assertEquals(
            'bigint',
            Schema::getColumnType('screenings', 'id'),
            'Az `id` oszlop típusa nem `bigint`.'
        );
    }

    
    public function test_screening_movie_id_column_is_bigint()
    {
        $this->assertEquals(
            'bigint',
            Schema::getColumnType('screenings', 'movie_id'),
            'A `movie_id` oszlop típusa nem `bigint`.'
        );
    }

    
    public function test_screening_drive_in_cinema_id_column_is_bigint()
    {
        $this->assertEquals(
            'bigint',
            Schema::getColumnType('screenings', 'drive_in_cinema_id'),
            'A `drive_in_cinema_id` oszlop típusa nem `bigint`.'
        );
    }

    
    public function test_screening_start_time_column_is_datetime()
    {
        $this->assertEquals(
            'datetime',
            Schema::getColumnType('screenings', 'start_time'),
            'A `start_time` oszlop típusa nem `datetime`.'
        );
    }

    
    public function test_screening_movie_id_is_not_nullable()
    {
        $this->assertFalse(
            Schema::getConnection()->getDoctrineColumn('screenings', 'movie_id')->getNotnull(),
            'A `movie_id` oszlopnak NOT NULL-nak kell lennie.'
        );
    }

    
    public function test_screening_drive_in_cinema_id_is_not_nullable()
    {
        $this->assertFalse(
            Schema::getConnection()->getDoctrineColumn('screenings', 'drive_in_cinema_id')->getNotnull(),
            'A `drive_in_cinema_id` oszlopnak NOT NULL-nak kell lennie.'
        );
    }

    
    public function test_screening_start_time_is_not_nullable()
    {
        $this->assertFalse(
            Schema::getConnection()->getDoctrineColumn('screenings', 'start_time')->getNotnull(),
            'A `start_time` oszlopnak NOT NULL-nak kell lennie.'
        );
    }

    public function test_a_screening_can_be_saved_to_database()
    {
        $this->assertDatabaseHas('screenings', [
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-24 20:00:00',
        ]);
    }

    
    public function test_a_screening_can_be_deleted_from_database()
    {
        $this->screening->delete();

        $this->assertDatabaseMissing('screenings', [
            'id' => $this->screening->id
        ]);
    }

    
    public function test_a_screening_can_be_updated_in_database()
    {
        $newStartTime = '2025-06-24 22:00:00';
        $this->screening->update(['start_time' => $newStartTime]);

        $this->assertDatabaseHas('screenings', [
            'id' => $this->screening->id,
            'start_time' => $newStartTime
        ]);
    }

    
    public function test_screening_movie_id_is_accessible()
    {
        $this->assertNotNull($this->screening->movie_id);
    }

    
    public function test_screening_drive_in_cinema_id_is_accessible()
    {
        $this->assertNotNull($this->screening->drive_in_cinema_id);
    }

    public function test_screening_start_time_is_accessible()
    {
        $this->assertNotNull($this->screening->start_time);
    }
}
