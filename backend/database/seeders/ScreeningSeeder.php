<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DriveInCinema;
use App\Models\Movie;
use App\Models\Screening;
use Carbon\Carbon;

class ScreeningSeeder extends Seeder
{
    // 3 és 4 között random generálja a vetítések számát naponta.
    // NEM ismétlődnek a filmek egymás után, random lehívja a filmeket és annyit tölt bele, ahány vetítés kell aznap!
    // Előző filmidő + 20 perc szünetet számol >> így áll össze 1 'blokk'!

    public function run()
    {
        $startDay = Carbon::today();
        $howManyDays = 14;

        foreach (DriveInCinema::all() as $cinema) {
            for ($day = 0; $day < $howManyDays; $day++) {
                $date = (clone $startDay)->addDays($day);
                $numScreenings = rand(3, 4);

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
