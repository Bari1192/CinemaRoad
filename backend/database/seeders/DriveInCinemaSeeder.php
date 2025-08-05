<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DriveInCinemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("drive_in_cinemas")->insert([
            [
                "name" => "Starfield Autósmozi",
                "location" => "Budapest, Kőbányai út 45",
                "description" => "A Starfield Autósmozi Budapest egyik legmodernebb kültéri vetítőhelye, ahol a klasszikus autósmozi élmény találkozik a mai technológiával. A látogatók kényelmesen élvezhetik a legújabb filmeket saját autójukból, FM-rádión keresztül hallgathatják a hangot, miközben friss popcorn és üdítő is rendelhető a mobilalkalmazáson keresztül.",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ]);
    }
}
