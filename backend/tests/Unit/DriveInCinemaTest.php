<?php

namespace Tests\Unit;

use App\Models\DriveInCinema;
use App\Models\Screening;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class DriveInCinemaTest extends TestCase
{
    use DatabaseTransactions;

    public function test_screening_has_belongs_to_DriveInCinema_relation()
    {
        
        $cinema = DriveInCinema::create([
            'name'        => 'Teszt Mozi',
            'location'    => 'Valami utca 1.',
            'description' => 'Test',
        ]);
        
        $screening = Screening::create([
            'movie_id'         => 1,
            'DriveInCinema_id' => $cinema->id,
            'start_time'       => "2025-06-24 18:00:00"
        ]);
        $this->assertEquals($cinema->id, $screening->DriveInCinema->id);
    }

    public function it_uses_the_correct_table_name(): void
    {
        $DriveInCinema = new DriveInCinema;
        $this->assertSame('DriveInCinemas', $DriveInCinema->getTable());
    }

    public function it_has_fillable_attributes(): void
    {
        $DriveInCinema = new DriveInCinema;
        $this->assertEquals(
            ['name', 'location', 'description'],
            $DriveInCinema->getFillable()
        );
    }
}
