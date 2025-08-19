<?php

namespace Tests\Unit\Models;

use App\Models\DriveInCinema;
use App\Models\Reservation;
use App\Models\Screening;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ReservationsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_it_uses_the_correct_table(): void
    {
        $reservation = new Reservation;

        $this->assertSame("reservations", $reservation->getTable());
    }

    public function test_it_has_fillable_attributes(): void
    {
        $reservation = new Reservation;

        $this->assertEquals(
            ["user_id",
            "confirmation",
            "location_id",
            "screening_id",
            "parkingspot",
            "reserved_at",
            "created_at",
            "updated_at"],
            $reservation->getFillable());

            
    }
    
    public function test_it_belongs_to_user(): void
    {
        $reservation = new Reservation;

        $this->assertInstanceOf(User::class, $reservation->user()->getRelated());
        $this->assertSame('user_id', $reservation->user()->getForeignKeyName());
    }

    public function test_it_belongs_to_screening(): void
    {
        $reservation = new Reservation;

        $this->assertInstanceOf(Screening::class, $reservation->screening()->getRelated());
        $this->assertSame('screening_id', $reservation->screening()->getForeignKeyName());
    }

    public function test_it_belongs_to_location(): void
    {
        $reservation = new Reservation;

        $this->assertInstanceOf(DriveInCinema::class, $reservation->location()->getRelated());
        $this->assertSame('location_id', $reservation->location()->getForeignKeyName());
    }

    public function test_it_uses_timestamps(): void
    {
        $reservation = new Reservation;

        $this->assertTrue($reservation->timestamps);
    }    
}
