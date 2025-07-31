<?php

namespace Database\Factories;

use App\Models\DriveInCinema;
use App\Models\Movie;
use App\Models\Screening;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Screening>
 */
class ScreeningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $screening = Screening::class;

    public static $today = today();

public function definition(): array
{
    $movie = Movie::inRandomOrder()->first();

    $start = self::$today;
    $end = (clone $start)->addMinutes($movie->duration_min + 20);

    self::$today = $end;

    return [
        'movie_id' => $movie->id,
        'drive_in_cinema_id' => 1,
        'start_time' => $start,
    ];
}
}
