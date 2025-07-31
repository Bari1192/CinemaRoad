<?php

namespace Database\Seeders;

use App\Models\DriveInCinema;
use App\Models\Movie;
use App\Models\Screening;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScreeningSeeder extends Seeder
{
    public function run(): void
    {
        $startDay = Carbon::parse(today());

        $howManyDays = 5;

        foreach (DriveInCinema::all() as $cinema) {

            for ($day = 0; $day < $howManyDays; $day++) { 
                $currentDay = (clone $startDay)->addDays($day);
                $movies = Movie::inRandomOrder()->take(5)->get();
    
                $startTime = (clone $currentDay)->setTime(16, 30);
    
                foreach ($movies as $movie) {
                    Screening::create([
                        'movie_id' => $movie->id,
                        'drive_in_cinema_id' => $cinema->id,
                        'start_time' => $startTime,
                    ]);
    
                    $startTime = (clone $startTime)->addMinutes($movie->duration_min + 20);
                }
            }
        }
    }
    // public function run(): void
    // {
    //     DB::table("screenings")->insert([
    //         [
    //             "movie_id" => 1,
    //             "drive_in_cinema_id" => 1,
    //             "start_time" => "2025-06-23 16:30:00"
    //         ],
    //         [
    //             "movie_id" => 2,
    //             "drive_in_cinema_id" => 1,
    //             "start_time" => "2025-06-24 18:00:00"
    //         ],
    //         [
    //             "movie_id" => 3,
    //             "drive_in_cinema_id" => 1,
    //             "start_time" => "2025-06-25 20:30:00"
    //         ],
    //         [
    //             "movie_id" => 3,
    //             "drive_in_cinema_id" => 1,
    //             "start_time" => "2025-06-25 22:30:00"
    //         ],
    //         [
    //             "movie_id" => 3,
    //             "drive_in_cinema_id" => 1,
    //             "start_time" => "2025-06-25 23:50:00"
    //         ],
    //     ]);
    // }
}
