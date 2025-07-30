<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $categoryTypes = [
            'action' => '/Action_Movies_img',
            'family' => '/Family_Movies_img', 
            'horror' => '/Horror_Movies_img',
        ];

        foreach ($categoryTypes as $movieType => $typePath) {
            foreach ($this->staticMoviesData($movieType, $typePath) as $movieData) {
                Movie::create([
                    'title' => $movieData['title'],
                    'description' => $movieData['description'],
                    'poster_url' => $movieData['poster_url'], 
                    'type' => $movieType,
                    'duration_min' => fake()->numberBetween(60, 90),
                ]);
            }
        }
    }
    public function staticMoviesData(string $movieType, string $basePathToImgs)
    {
        return match ($movieType) {
            'action' => [
                [
                    "title" => "Neon Siege",
                    "description" => "Egy elbukott város, ahol a neonfények mögött háború dúl. Egy magányos kommandós szembeszáll a múltjával, hogy megállítson egy fegyvercsempész-hálózatot, mielőtt elszabadul a pokol.",
                    "poster_url" => $basePathToImgs . '/Neon_Siege.webp'
                ],

                ["title" => "Steel Horizon", "description" => "A jövő tengerein már nem a hullámok uralkodnak. Egy renegát kapitány és csapata harcba száll a világ utolsó olajkészleteiért – a túlélés ára az árulás.", "poster_url" => $basePathToImgs . '/steel_horizon.jpg'],
                ["title" => "Bullet Protocol", "description" => "Egy titkos ügynök utolsó küldetése gyorsan személyes bosszúvá válik. A golyók útját senki sem állíthatja meg – főleg, ha a célpont a rendszer maga.", "poster_url" => $basePathToImgs . '/Bullet_Protocol.webp'],
                ["title" => "Urban Vendetta", "description" => "Az utcákon nincs igazság, csak túlélés. Egy visszavonult zsaru újra fegyvert ragad, hogy megtisztítsa a várost attól, amit egykor ő is segített felépíteni.", "poster_url" => $basePathToImgs . '/Urban_Vendetta.webp'],
                ["title" => "Code Red Omega", "description" => "Egy globális kibertámadás csak a kezdet. Egy elit hackercsapat versenyt fut az idővel, hogy megállítsa az Omega-protokoll aktiválását – vagy vége az emberiségnek.", "poster_url" => $basePathToImgs . '/Code_Red.webp'],
            ],
            'family' => [
                ["title" => "Cirmos Karácsony", "description" => "Egy kisvárosi család karácsonya felfordul, amikor egy beszélő cica költözik hozzájuk. A varázslatos kaland megtanítja, mi is az igazi szeretet ünnepe.", "poster_url" => $basePathToImgs . '/Cirmos_Karacsony.webp'],
                ["title" => "A Házikó a Fán", "description" => "Két testvér egy rejtett fára épített házikót talál, ami ajtót nyit egy másik világba. Ám ahhoz, hogy hazajussanak, előbb meg kell menteniük egy mesebeli birodalmat.", "poster_url" => $basePathToImgs . '/Haziko_a_fan.webp'],
                ["title" => "Mesés Kutyák Klubja", "description" => "Egy csapat kóbor kutya titkos klubot működtet a város alatt. Mikor veszélybe kerül új otthonuk, össze kell fogniuk, hogy megmentsék a menhelyet – és közben embereket is.", "poster_url" => $basePathToImgs . '/Meses_kutyak_klubja.jpg'],
                ["title" => "Tündérek Titkai", "description" => "Egy kíváncsi kislány rábukkan egy régi hídra, amit tündérek őriznek. A mese életre kel, mikor az álom és valóság határai összemosódnak.", "poster_url" => $basePathToImgs . '/A_Tunderek_titkai.webp'],
                ["title" => "Apa, hol a Nap?", "description" => "Amikor a Nap eltűnik az égről, egy kislány és apukája egy varázslatos utazásra indulnak, hogy visszahozzák a fényt a világnak – és egymás szívébe.", "poster_url" => $basePathToImgs . '/Apa_hol_a_nap.webp'],
            ],

            'horror' => [
                ["title" => "Ne Nyisd Ki!", "description" => "Egy titokzatos láda, amit generációk óta elzárva őriztek. Amikor egy kíváncsi fiú mégis felnyitja, valami ősi gonosz szabadul el – és nem lehet visszazárni.", "poster_url" => $basePathToImgs . '/Ne_nyisd_ki.jpg'],
                ["title" => "Éjfél után", "description" => "A város elcsendesedik, de ő akkor indul útnak. Egy rádiós műsorvezető titokzatos hívásokat kap – mindegyik pontosan éjfél után, és mindegyik egy újabb gyilkosságot jósol.", "poster_url" => $basePathToImgs . '/Ejfel_utan.jpg'],
                ["title" => "A Suttogó", "description" => "A kis faluban mindenki hallott már a suttogásokról – de senki sem beszél róla. Egy fiatal nő visszatér gyermekkora otthonába, ahol az emlékek és a sötétség összefonódnak.", "poster_url" => $basePathToImgs . '/A_suttogo.jpg'],
                ["title" => "Háborgás az Emeleten", "description" => "Egy régi bérház legfelső emeletéről különös zajok szűrődnek le éjszakánként. Az új lakó csak egy dolgot nem ért=> miért néz rá mindig vissza az a tükör?", "poster_url" => $basePathToImgs . '/Haborgas_az_emeleten.jpg'],
                ["title" => "Fekete Tó", "description" => "A nyári táborozás pokollá válik, mikor a tó partján különös események kezdődnek. Valami a víz alatt figyel... és sosem jött fel levegőért.", "poster_url" => $basePathToImgs . '/Fekete_to.jpg'],
            ],
        };
    }
}
