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
            ],
            [
                "name" => "Horizon Drive",
                "location" => "Budapest, IX. kerület, Mester utca 88",
                "description" => "A városi pihenés új dimenziója. Budapest szívében, Kőbányán található kültéri autósmozi, ahol a filmnézés élménye összeolvad a modern technológiával és a kényelmes szabadtéri szórakozással. Komfortos parkolóhelyekkel, kiváló hangminőséggel az FM rádión keresztül, valamint könnyedén rendelhető friss popcornnal és italokkal a mobilalkalmazás segítségével várunk mindenkit, aki szeretne egy különleges, nosztalgikus, mégis mai filmes élményben részesülni.",
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                "name" => "Orbit Cinema",
                "location" => "Budapest, XI. kerület, Hegyalja út 30",
                "description" => "Budapest zöldövezeti részén, Budán található új kültéri autósmozi, ahol a klasszikus autósmozi hangulat a legmodernebb technológiával ötvöződik. Kényelmes parkolóhelyekkel, kiváló látványvilággal várjuk a filmrajongókat, hogy saját autójukból élvezhessék a legfrissebb filmeket. Az FM rádiós hangátvitel tiszta hangzást biztosít, miközben a friss popcorn és üdítő egyszerűen, a mobilalkalmazáson keresztül rendelhető meg, hogy az este zavartalanul teljen.",
                "created_at" => now(),
                "updated_at" => now()
            ]
        ]);
    }
}
