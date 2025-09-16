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
        // LEGELSŐNEK ITT IS A PREMIEREKET GENERÁLJA LE! 
        // CSAK UTÁNA jöhetnek a "normál" vetítések.

        // ELSŐ: Premier vetítések. Alapból csütörtök -> premier nap. Minden Moziban (18:00-kor, [release_date] nappal)
        $this->createPremierScreenings();

        // MÁSODIK: Normál vetítések (ugyanúgy, mint eddig, csak a premier napot "kihagyjuk" a generálásból)
        $this->createRegularScreenings();
    }

    private function createPremierScreenings()
    {
        $premierMovies = Movie::where('is_premier', true)->get();
        $cinemas = DriveInCinema::all();

        if ($premierMovies->count() !== 3 || $cinemas->count() < 3) {
            $this->command->error('Nem megfelelő premier filmek vagy mozik száma!');
            return;
        }

        // Minden premier film egy moziba kerül, 18:00-kor
        foreach ($premierMovies as $index => $movie) {
            $cinema = $cinemas->get($index);

            Screening::create([
                'movie_id' => $movie->id,
                'drive_in_cinema_id' => $cinema->id,
                'start_time' => $movie->release_date->copy()->setTime(18, 0),
            ]);
            $this->command->info(
                "\n🎬 Premier Film 🎬 \nFilm címe: {$movie->title}\nMozihelyszín: {$cinema->name} \nIdőpont: {$movie->release_date->copy()->setTime(18, 0)->format('Y-m-d H:i')} kezdéssel."
            );
        }
    }

    private function createRegularScreenings()
    {
        $startDay = Carbon::today();
        $howManyDays = 14;

        // Premier dátum lekérése
        $premierDate = Movie::where('is_premier', true)->first()?->release_date;

        $this->command->newLine();
        foreach (DriveInCinema::all() as $cinema) {
            for ($day = 0; $day < $howManyDays; $day++) {
                $date = (clone $startDay)->addDays($day);

                // Ha ez premier nap, akkor ezt a mozit kihagyjuk ezen a napon!!!
                if ($premierDate && $date->isSameDay($premierDate)) {
                    // Megnézi, hogy van-e premier vetítés abban a moziban?
                    $hasPremierScreening = Screening::join('movies', 'screenings.movie_id', '=', 'movies.id')
                        ->where('screenings.drive_in_cinema_id', $cinema->id)
                        ->where('movies.is_premier', true)
                        ->whereDate('screenings.start_time', $date)
                        ->exists();

                    if ($hasPremierScreening) {
                        $this->command->info("A(z) [{$cinema->name}] mozihelyszínen {$date->format('Y-m-d')} dátummal premier vetítés lesz.");
                        continue; // Ez a mozi ezen a napon kihagyva
                    }
                }

                // Normál vetítések 
                $numScreenings = 4;
                $movies = Movie::where('is_premier', false)
                    ->inRandomOrder()
                    ->take($numScreenings)
                    ->get();

                $startTime = (clone $date)->setTime(16, 30);

                foreach ($movies as $movie) {
                    Screening::create([
                        'drive_in_cinema_id' => $cinema->id,
                        'movie_id' => $movie->id,
                        'start_time' => $startTime,
                    ]);

                    $startTime = (clone $startTime)->addMinutes($movie->duration_min + 20);
                }
            }
        }

        // Eskü imádok ezzel kiírni :D 
        $this->command->newLine();
        $this->command->info('A további vetítések szinkronizálva lettek a premier napok figyelembevételével.');
        $this->command->newLine();
    }
}
