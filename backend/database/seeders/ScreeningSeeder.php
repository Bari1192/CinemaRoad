<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DriveInCinema;
use App\Models\Movie;
use App\Models\Screening;
use Carbon\Carbon;

class ScreeningSeeder extends Seeder
{
    public function run()
    {
        $startDay = Carbon::today();
        $howManyDays = 14;

        foreach (DriveInCinema::all() as $cinema) {
            for ($day = 0; $day < $howManyDays; $day++) {
                $date = (clone $startDay)->addDays($day);
                $numScreenings = 4;

                $movies = Movie::inRandomOrder()->take($numScreenings)->get();

                $startTime = (clone $date)->setTime(16, 30);

                foreach ($movies as $movie) {
                    Screening::factory()
                        ->state([
                            'drive_in_cinema_id' => $cinema->id,
                            'movie_id' => $movie->id,
                            'start_time' => $startTime,
                        ])
                        ->create();
                    $startTime = (clone $startTime)->addMinutes($movie->duration_min + 20);
                }
            }
        }
    }
}
