<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScreeningSeeder extends Seeder
{
    public function run(): void
    {
        DB::table("screenings")->insert([
            [
                "movie_id" => 1,
                "drive_in_cinema_id" => 1,
                "start_time" => "2025-06-23 16:30:00"
            ]
        ]);
    }
}
