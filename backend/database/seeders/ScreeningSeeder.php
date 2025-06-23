<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScreeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("screenings")->insert([
            [
                "movie_id" => 1,
                "driveincinema_id" => 1,
                "start_time" => "2025-06-23 16:30:00"
            ]
        ]);
    }
}
