<?php

namespace Tests\Unit\DatabaseTests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MovieDatabaseTest extends TestCase
{
    use DatabaseTransactions;

    public function test_movies_table_exists()
    {
        $this->assertTrue(
            Schema::hasTable('movies'),
            'A `movies` tábla nem jött létre az adatbázisban.'
        );
    }

    public function test_movies_table_has_id_column()
    {
        $this->assertTrue(
            Schema::hasColumn('movies', 'id'),
            'A `movies` táblában nincs `id` oszlop.'
        );
    }

    public function test_movie_id_column_is_bigint()
    {
        $this->assertEquals(
            'bigint',
            Schema::getColumnType('movies', 'id'),
            'Az `id` oszlop típusa nem `bigint`.'
        );
    }

    public function test_movies_table_has_title_column()
    {
        $this->assertTrue(
            Schema::hasColumn('movies', 'title'),
            'A `movies` táblában nincs `title` oszlop.'
        );
    }

    public function test_movie_title_column_is_varchar()
    {
        $this->assertEquals(
            'varchar',
            Schema::getColumnType('movies', 'title'),
            'A `title` oszlop típusa nem `varchar`.'
        );
    }

    public function test_movies_table_has_description_column()
    {
        $this->assertTrue(
            Schema::hasColumn('movies', 'description'),
            'A `movies` táblában nincs `description` oszlop.'
        );
    }

    public function test_movie_description_column_is_text()
    {
        $this->assertEquals(
            'text',
            Schema::getColumnType('movies', 'description'),
            'A `description` oszlop típusa nem `text`.'
        );
    }


    public function test_movies_table_has_duration_min_column()
    {
        $this->assertTrue(
            Schema::hasColumn('movies', 'duration_min'),
            'A `movies` táblában nincs `duration_min` oszlop.'
        );
    }

    public function test_movie_duration_min_column_is_integer()
    {
        $this->assertEquals(
            'int',
            Schema::getColumnType('movies', 'duration_min'),
            'A `duration_min` oszlop típusa nem `int`.'
        );
    }


    public function test_movies_table_has_poster_url_column()
    {
        $this->assertTrue(
            Schema::hasColumn('movies', 'poster_url'),
            'A `movies` táblában nincs `poster_url` oszlop.'
        );
    }

    public function test_movie_poster_url_column_is_varchar()
    {
        $this->assertEquals(
            'varchar',
            Schema::getColumnType('movies', 'poster_url'),
            'A `poster_url` oszlop típusa nem `varchar`.'
        );
    }

    public function test_movies_table_has_created_at_column()
    {
        $this->assertTrue(
            Schema::hasColumn('movies', 'created_at'),
            'A `movies` táblában nincs `created_at` oszlop.'
        );
    }

    public function test_movie_created_at_column_is_datetime()
    {
        $this->assertEquals(
            'timestamp',
            Schema::getColumnType('movies', 'created_at'),
            'A `created_at` oszlop típusa nem `timestamp`.'
        );
    }

    public function test_movies_table_has_updated_at_column()
    {
        $this->assertTrue(
            Schema::hasColumn('movies', 'updated_at'),
            'A `movies` táblában nincs `updated_at` oszlop.'
        );
    }
    public function test_movie_updated_at_column_is_datetime()
    {
        $this->assertEquals(
            'timestamp',
            Schema::getColumnType('movies', 'updated_at'),
            'Az `updated_at` oszlop típusa nem `timestamp`.'
        );
    }
}
