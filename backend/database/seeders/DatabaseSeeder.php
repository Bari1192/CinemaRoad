<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(MovieSeeder::class);
        $this->call(DriveInCinemaSeeder::class);
        $this->call(ScreeningSeeder::class);
    }
}
