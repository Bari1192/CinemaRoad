<?php

namespace Tests\Unit\DatabaseTests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PurchasesDatabaseTest extends TestCase
{
    use DatabaseTransactions;

    public function test_purchases_table_exists()
    {
        $this->assertTrue(
            Schema::hasTable('purchases'),
            'A `purchases` tábla nem jött létre az adatbázisban.'
        );
    }

    // I D
    public function test_purchases_table_has_id_column()
    {
        $this->assertTrue(
            Schema::hasColumn('purchases', 'id'),
            'A `purchases` táblában nincs `id` oszlop.'
        );
    }

    public function test_purchase_id_column_is_bigint()
    {
        $this->assertEquals(
            'bigint',
            Schema::getColumnType('purchases', 'id'),
            'Az `id` oszlop típusa nem `bigint`.'
        );
    }


    // S C R E E N I N G    I D
    public function test_purchases_table_has_screening_id_column()
    {
        $this->assertTrue(
            Schema::hasColumn('purchases', 'screening_id'),
            'A `purchases` táblában nincs `screening_id` oszlop.'
        );
    }

    public function test_purchase_screening_id_column_is_bigint()
    {
        $this->assertEquals(
            'bigint',
            Schema::getColumnType('purchases', 'screening_id'),
            'A `screening_id` oszlop típusa nem `bigint`.'
        );
    }

    // L O C A T I O N    I D
    public function test_purchases_table_has_location_id_column()
    {
        $this->assertTrue(
            Schema::hasColumn('purchases', 'location_id'),
            'A `purchases` táblában nincs `location_id` oszlop.'
        );
    }

    public function test_purchase_location_id_column_is_bigint()
    {
        $this->assertEquals(
            'bigint',
            Schema::getColumnType('purchases', 'location_id'),
            'A `location_id` oszlop típusa nem `bigint`.'
        );
    }

    // M O V I E    I D
    public function test_purchases_table_has_movie_id_column()
    {
        $this->assertTrue(
            Schema::hasColumn('purchases', 'movie_id'),
            'A `purchases` táblában nincs `movie_id` oszlop.'
        );
    }

    public function test_purchase_movie_id_column_type_is_bigint()
    {
        $this->assertEquals(
            'bigint',
            Schema::getColumnType('purchases', 'movie_id'),
            'A `movie_id` oszlop típusa nem `bigint`.'
        );
    }

    // U S E R    I D
    public function test_purchases_table_has_user_id_column()
    {
        $this->assertTrue(
            Schema::hasColumn('purchases', 'user_id'),
            'A `purchases` táblában nincs `user_id` oszlop.'
        );
    }

    public function test_purchase_user_id_column_type_is_date()
    {
        $this->assertEquals(
            'bigint',
            Schema::getColumnType('purchases', 'user_id'),
            'A `user_id` oszlop típusa nem `bigint` formátumú.'
        );
    }

    // T I C K E T    C O D E
    public function test_purchases_table_has_ticket_code_column()
    {
        $this->assertTrue(
            Schema::hasColumn('purchases', 'ticket_code'),
            'A `purchases` táblában nincs `ticket_code` oszlop.'
        );
    }

    public function test_purchase_ticket_code_column_is_bigint()
    {
        $this->assertEquals(
            'varchar',
            Schema::getColumnType('purchases', 'ticket_code'),
            'A `ticket_code` oszlop típusa nem `varchar`.'
        );
    }

    // G U E S T    E M A I L
    public function test_purchases_table_has_guest_email_column()
    {
        $this->assertTrue(
            Schema::hasColumn('purchases', 'guest_email'),
            'A `purchases` táblában nincs `guest_email` oszlop.'
        );
    }

    public function test_purchase_guest_email_column_is_varchar()
    {
        $this->assertEquals(
            'varchar',
            Schema::getColumnType('purchases', 'guest_email'),
            'A `guest_email` oszlop típusa nem `varchar`.'
        );
    }

    // P A R K I N G    S P O T
    public function test_purchases_table_has_parkingspot_column()
    {
        $this->assertTrue(
            Schema::hasColumn('purchases', 'parkingspot'),
            'A `purchases` táblában nincs `parkingspot` oszlop.'
        );
    }

    public function test_purchase_guest_parkingspot_column_is_varchar()
    {
        $this->assertEquals(
            'varchar',
            Schema::getColumnType('purchases', 'parkingspot'),
            'A `parkingspot` oszlop típusa nem `varchar`.'
        );
    }

    // C R E A T E D    A T
    public function test_purchases_table_has_created_at_column()
    {
        $this->assertTrue(
            Schema::hasColumn('purchases', 'created_at'),
            'A `purchases` táblában nincs `created_at` oszlop.'
        );
    }

    public function test_purchase_guest_created_at_column_is_timestamp()
    {
        $this->assertEquals(
            'timestamp',
            Schema::getColumnType('purchases', 'created_at'),
            'A `created_at` oszlop típusa nem `timestamp`.'
        );
    }

    // U P D A T E D    A T
    public function test_purchase_updated_at_column_is_datetime()
    {
        $this->assertEquals(
            'timestamp',
            Schema::getColumnType('purchases', 'updated_at'),
            'A `updated_at` oszlop típusa nem `timestamp`.'
        );
    }

    public function test_purchase_guest_updated_at_column_is_timestamp()
    {
        $this->assertEquals(
            'timestamp',
            Schema::getColumnType('purchases', 'updated_at'),
            'A `updated_at` oszlop típusa nem `timestamp`.'
        );
    }
}