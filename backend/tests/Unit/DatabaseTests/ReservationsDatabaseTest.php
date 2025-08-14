<?php

namespace Tests\Unit\DatabaseTests;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ReservationsDatabaseTest extends TestCase
{
    use DatabaseTransactions;

    // T A B L E
    public function test_reservations_table_exists()
    {
        $this->assertTrue(
            Schema::hasTable('reservations'),
            'A `reservations` tábla nem jött létre az adatbázisban.'
        );
    }

    // I D
    public function test_reservations_table_has_id_column()
    {
        $this->assertTrue(
            Schema::hasColumn('reservations', 'id'),
            'A `reservations` táblában nincs `id` oszlop.'
        );
    }

    public function test_id_column_is_bigint()
    {
        $this->assertEquals(
            'bigint',
            Schema::getColumnType('reservations', 'id'),
            'Az `id` oszlop típusa nem `bigint`.'
        );
    }

    // U S E R    I D
    public function test_reservations_table_has_user_id_column()
    {
        $this->assertTrue(
            Schema::hasColumn('reservations', 'user_id'),
            'A `reservations` táblában nincs `user_id` oszlop.'
        );
    }

    public function test_reservations_user_id_column_is_bigint()
    {
        $this->assertEquals(
            'bigint',
            Schema::getColumnType('reservations', 'user_id'),
            'A `user_id` oszlop típusa nem `bigint`.'
        );
    }
    
    // S C R E E N I N G    I D
    public function test_reservations_table_has_screening_id_column()
    {
        $this->assertTrue(
            Schema::hasColumn('reservations', 'screening_id'),
            'A `reservations` táblában nincs `screening_id` oszlop.'
        );
    }

    public function test_reservations_screening_id_column_type_is_bigint()
    {
        $this->assertEquals(
            'bigint',
            Schema::getColumnType('reservations', 'screening_id'),
            'A `screening_id` oszlop típusa nem `bigint`.'
        );
    }

    // L O C A T I O N    I D
    public function test_reservations_table_has_location_id_column()
    {
        $this->assertTrue(
            Schema::hasColumn('reservations', 'location_id'),
            'A `reservations` táblában nincs `location_id` oszlop.'
        );
    }

    public function test_reservations_location_id_column_is_bigint()
    {
        $this->assertEquals(
            'bigint',
            Schema::getColumnType('reservations', 'location_id'),
            'A `location_id` oszlop típusa nem `text`.'
        );
    }

    // R E S E R V E D    A T
    public function test_reservations_table_has_reserved_at_column()
    {
        $this->assertTrue(
            Schema::hasColumn('reservations', 'reserved_at'),
            'A `reservations` táblában nincs `reserved_at` oszlop.'
        );
    }

    public function test_reservations_reserved_at_column_is_datetime()
    {
        $this->assertEquals(
            'datetime',
            Schema::getColumnType('reservations', 'reserved_at'),
            'A `reserved_at` oszlop típusa nem `datetime`.'
        );
    }

    // P A R K I N G    S P O T
    public function test_reservations_table_has_parkingspot_column()
    {
        $this->assertTrue(
            Schema::hasColumn('reservations', 'parkingspot'),
            'A `reservations` táblában nincs `parking_spot` oszlop.'
        );
    }

    public function test_reservations_parking_spotcolumn_type_is_varchar()
    {
        $this->assertEquals(
            'varchar',
            Schema::getColumnType('reservations', 'parkingspot'),
            'A `parking_spot` oszlop típusa nem `varchar` formátumú.'
        );
    }

    

}
