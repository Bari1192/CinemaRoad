<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DriveInCinemaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table("drive_in_cinemas")->insert([
            [
                "name" => "Starfield",
                "location" => "Budapest, X. kerület, Kőbányai út 45",
                "description" => "A Starfield Autósmozi Budapest egyik legmodernebb kültéri vetítőhelye, ahol a klasszikus autósmozi élmény találkozik a mai technológiával. A látogatók kényelmesen élvezhetik a legújabb filmeket saját autójukból, FM-rádión keresztül hallgathatják a hangot, miközben friss popcorn és üdítő is rendelhető a mobilalkalmazáson keresztül.",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Horizon Drive",
                "location" => "Miskolc, Szentpéteri kapu 102",
                "description" => "A Horizon Drive Miskolc peremén, a Szentpéteri kapunál várja a filmrajongókat. A tágas parkolóhelyek és a kiváló hangminőségű FM-rádiós közvetítés révén a vendégek kényelmesen élvezhetik a filmeket saját autójukból. A mozi különlegessége, hogy a borsodi táj látványa háttérként szolgál, így a filmnézés egyedi hangulatot kap. A friss popcorn és üdítők rendelése a mobilalkalmazáson keresztül történik, így minden adott egy felejthetetlen esti kikapcsolódáshoz.",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Orbit Cinema",
                "location" => "Debrecen, Nagyerdei körút 72",
                "description" => "Az Orbit Cinema Debrecen szívében, a Nagyerdő közelében nyújt autósmozis élményt. A helyszín különleges atmoszféráját a természetközeli környezet és a modern vetítéstechnika ötvözete adja. A filmeket kristálytiszta képminőségben és FM-rádiós hangátvitellel élvezhetik a vendégek, miközben az alkalmazáson keresztül rendelt friss popcorn és hideg ital gondoskodik a zavartalan szórakozásról. Az Orbit Cinema ideális választás mindazok számára, akik különleges esti programra vágynak Debrecenben.",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ]);
    }
}
