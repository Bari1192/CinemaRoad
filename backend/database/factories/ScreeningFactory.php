<?php

namespace Database\Factories;

use App\Models\DriveInCinema;
use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScreeningFactory extends Factory
{

    public function definition(): array
    {
        return [
            'drive_in_cinema_id' => $this->faker->randomElement(DriveInCinema::pluck('id')),
            'movie_id' => $this->faker->randomElement(Movie::pluck('id')),
            'start_time' => now(),
        ];
    }
}
