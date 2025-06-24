<?php

namespace Tests\Unit\DatabaseTests;

use App\Models\DriveInCinema;
use App\Models\Movie; 
use App\Models\Screening;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class DriveInCinemaDatabaseTest extends TestCase
{
    use DatabaseTransactions;

    protected DriveInCinema $cinema;
    protected Movie $movie; 
    protected Screening $screening;

    protected function setUp(): void
    {
        parent::setUp();

        $this->cinema = DriveInCinema::create([
            "name" => "Test Cinema Name",
            "location" => "Test Cinema Location",
            "description" => "Test Cinema Description"
        ]);

        $this->movie = Movie::create([
            "title" => "Test Movie For Cinema",
            "duration_min" => 90,
        ]);

        $this->screening = Screening::create([
            'movie_id' => $this->movie->id,
            'drive_in_cinema_id' => $this->cinema->id,
            'start_time' => '2025-06-24 20:00:00',
        ]);
    }

    
    public function test_drive_in_cinemas_table_exists()
    {
        $this->assertTrue(
            Schema::hasTable('drive_in_cinemas'),
            'A `drive_in_cinemas` tábla nem jött létre az adatbázisban.'
        );
    }

    public function test_drive_in_cinemas_table_has_id_column()
    {
        $this->assertTrue(
            Schema::hasColumn('drive_in_cinemas', 'id'),
            'A `drive_in_cinemas` táblában nincs `id` oszlop.'
        );
    }

    
    public function test_drive_in_cinemas_table_has_name_column()
    {
        $this->assertTrue(
            Schema::hasColumn('drive_in_cinemas', 'name'),
            'A `drive_in_cinemas` táblában nincs `name` oszlop.'
        );
    }

    
    public function test_drive_in_cinemas_table_has_location_column()
    {
        $this->assertTrue(
            Schema::hasColumn('drive_in_cinemas', 'location'),
            'A `drive_in_cinemas` táblában nincs `location` oszlop.'
        );
    }

    
    public function test_drive_in_cinemas_table_has_description_column()
    {
        $this->assertTrue(
            Schema::hasColumn('drive_in_cinemas', 'description'),
            'A `drive_in_cinemas` táblában nincs `description` oszlop.'
        );
    }

    public function test_drive_in_cinema_id_column_is_bigint()
    {
        $this->assertEquals(
            'bigint',
            Schema::getColumnType('drive_in_cinemas', 'id'),
            'Az `id` oszlop típusa nem `bigint`.'
        );
    }

    
    public function test_drive_in_cinema_name_column_is_varchar()
    {
        $this->assertEquals(
            'varchar',
            Schema::getColumnType('drive_in_cinemas', 'name'),
            'A `name` oszlop típusa nem `varchar`.'
        );
    }

    
    public function test_drive_in_cinema_name_column_is_not_nullable()
    {
        $this->assertFalse(
            Schema::getConnection()->getDoctrineColumn('drive_in_cinemas', 'name')->getNotnull(),
            'A `name` oszlopnak NOT NULL-nak kell lennie.'
        );
    }

    
    public function test_drive_in_cinema_location_column_is_varchar()
    {
        $this->assertEquals(
            'varchar',
            Schema::getColumnType('drive_in_cinemas', 'location'),
            'A `location` oszlop típusa nem `varchar`.'
        );
    }

    
    public function test_drive_in_cinema_location_column_is_not_nullable()
    {
        $this->assertFalse(
            Schema::getConnection()->getDoctrineColumn('drive_in_cinemas', 'location')->getNotnull(),
            'A `location` oszlopnak NOT NULL-nak kell lennie.'
        );
    }

    
    public function test_drive_in_cinema_description_column_is_text()
    {
        $this->assertEquals(
            'text',
            Schema::getColumnType('drive_in_cinemas', 'description'),
            'A `description` oszlop típusa nem `text`.'
        );
    }

    
    public function test_drive_in_cinema_description_column_is_nullable()
    {
        $this->assertTrue(
            Schema::getConnection()->getDoctrineColumn('drive_in_cinemas', 'description')->getNotnull(),
            'A `description` oszlopnak NULLABLE-nek kell lennie.'
        );
    }

    public function test_a_drive_in_cinema_is_saved_to_database()
    {
        $this->assertDatabaseHas('drive_in_cinemas', [
            'name' => 'Test Cinema Name',
            'location' => 'Test Cinema Location',
            'description' => 'Test Cinema Description',
        ]);
    }

    
    public function test_a_drive_in_cinema_can_be_deleted()
    {
        $id = $this->cinema->id;
        $this->cinema->delete();

        $this->assertDatabaseMissing('drive_in_cinemas', [
            'id' => $id
        ]);
    }

    
    public function test_a_drive_in_cinema_can_be_updated()
    {
        $newName = 'Updated Cinema Name';
        $this->cinema->update(['name' => $newName]);

        $this->assertDatabaseHas('drive_in_cinemas', [
            'id' => $this->cinema->id,
            'name' => $newName
        ]);
    }

    public function test_drive_in_cinema_name_is_accessible()
    {
        $this->assertNotNull($this->cinema->name);
    }

    
    public function test_drive_in_cinema_location_is_accessible()
    {
        $this->assertNotNull($this->cinema->location);
    }

    
    public function test_drive_in_cinema_description_is_accessible()
    {
        $this->assertNotNull($this->cinema->description);
    }
}