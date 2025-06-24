<?php

namespace Tests\Unit;

use App\Models\Driveincinema;
use App\Models\Screening;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class DriveincinemaTest extends TestCase
{
    use DatabaseTransactions;

    public function test_screening_has_belongs_to_driveincinema_relation()
    {
        
        $cinema = DriveinCinema::create([
            'name'        => 'Teszt Mozi',
            'location'    => 'Valami utca 1.',
            'description' => 'Test',
        ]);
        
        $screening = Screening::create([
            'movie_id'         => 1,
            'driveincinema_id' => $cinema->id,
            'start_time'       => "2025-06-24 18:00:00"
        ]);
        $this->assertEquals($cinema->id, $screening->driveinCinema->id);
    }

    public function it_uses_the_correct_table_name(): void
    {
        $driveinCinema = new Driveincinema;
        $this->assertSame('driveincinemas', $driveinCinema->getTable());
    }

    public function it_has_fillable_attributes(): void
    {
        $driveinCinema = new Driveincinema;
        $this->assertEquals(
            ['name', 'location', 'description'],
            $driveinCinema->getFillable()
        );
    }
}
