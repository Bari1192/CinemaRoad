<?php

namespace Database\Seeders;

use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {

        // Premier filmeknek hamarabb kell felmenniük, mint a "normálnak" (többsíkú seedelés megint)
        $this->createPremierMovies();


        $categoryTypes = [
            'action' => '/img/Action_Movies_img',
            'family' => '/img/Family_Movies_img',
            'horror' => '/img/Horror_Movies_img',
        ];

        foreach ($categoryTypes as $movieType => $typePath) {
            foreach ($this->staticMoviesData($movieType, $typePath) as $movieData) {
                Movie::create([
                    'title' => $movieData['title'],
                    'description' => $movieData['description'],
                    'poster_url' => $movieData['poster_url'],
                    'type' => $movieType,
                    'director' => fake()->firstName() . ' ' . fake()->lastName(),
                    'release_date' => Carbon::parse(fake()->dateTimeBetween('-180 days', 'now'), 'Y-m-d'),
                    'age_limit' => $movieData['age_limit'],
                    'duration_min' => fake()->numberBetween(60, 90),
                    'actors' => $this->generateActors($movieType)
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
                    "age_limit" => 18,
                    "poster_url" => $basePathToImgs . '/Neon_Siege.webp'
                ],

                ["title" => "Steel Horizon",  "age_limit" => 16, "description" => "A jövő tengerein már nem a hullámok uralkodnak. Egy renegát kapitány és csapata harcba száll a világ utolsó olajkészleteiért – a túlélés ára az árulás.", "poster_url" => $basePathToImgs . '/steel_horizon.webp'],
                ["title" => "Bullet Protocol", "age_limit" => 16, "description" => "Egy titkos ügynök utolsó küldetése gyorsan személyes bosszúvá válik. A golyók útját senki sem állíthatja meg – főleg, ha a célpont a rendszer maga.", "poster_url" => $basePathToImgs . '/Bullet_Protocol.webp'],
                ["title" => "Urban Vendetta", "age_limit" => 16, "description" => "Az utcákon nincs igazság, csak túlélés. Egy visszavonult zsaru újra fegyvert ragad, hogy megtisztítsa a várost attól, amit egykor ő is segített felépíteni.", "poster_url" => $basePathToImgs . '/Urban_Vendetta.webp'],
                ["title" => "Code Red Omega", "age_limit" => 18, "description" => "Egy globális kibertámadás csak a kezdet. Egy elit hackercsapat versenyt fut az idővel, hogy megállítsa az Omega-protokoll aktiválását – vagy vége az emberiségnek.", "poster_url" => $basePathToImgs . '/Code_Red.webp'],
            ],
            'family' => [
                ["title" => "Cirmos Karácsony", "age_limit" => 0, "description" => "Egy kisvárosi család karácsonya felfordul, amikor egy beszélő cica költözik hozzájuk. A varázslatos kaland megtanítja, mi is az igazi szeretet ünnepe.", "poster_url" => $basePathToImgs . '/Cirmos_Karacsony.webp'],
                ["title" => "A Házikó a Fán", "age_limit" => 0, "description" => "Két testvér egy rejtett fára épített házikót talál, ami ajtót nyit egy másik világba. Ám ahhoz, hogy hazajussanak, előbb meg kell menteniük egy mesebeli birodalmat.", "poster_url" => $basePathToImgs . '/Haziko_a_fan.webp'],
                ["title" => "Mesés Kutyák Klubja", "age_limit" => 4, "description" => "Egy csapat kóbor kutya titkos klubot működtet a város alatt. Mikor veszélybe kerül új otthonuk, össze kell fogniuk, hogy megmentsék a menhelyet – és közben embereket is.", "poster_url" => $basePathToImgs . '/Meses_kutyak_klubja.jpg'],
                ["title" => "Tündérek Titkai", "age_limit" => 6, "description" => "Egy kíváncsi kislány rábukkan egy régi hídra, amit tündérek őriznek. A mese életre kel, mikor az álom és valóság határai összemosódnak.", "poster_url" => $basePathToImgs . '/A_Tunderek_titkai.webp'],
                ["title" => "Apa, hol a Nap?", "age_limit" => 6, "description" => "Amikor a Nap eltűnik az égről, egy kislány és apukája egy varázslatos utazásra indulnak, hogy visszahozzák a fényt a világnak – és egymás szívébe.", "poster_url" => $basePathToImgs . '/Apa_hol_a_nap.webp'],
            ],

            'horror' => [
                ["title" => "Ne Nyisd Ki!", "age_limit" => 18, "description" => "Egy titokzatos láda, amit generációk óta elzárva őriztek. Amikor egy kíváncsi fiú mégis felnyitja, valami ősi gonosz szabadul el – és nem lehet visszazárni.", "poster_url" => $basePathToImgs . '/Ne_nyisd_ki.jpg'],
                ["title" => "Éjfél után", "age_limit" => 18, "description" => "A város elcsendesedik, de ő akkor indul útnak. Egy rádiós műsorvezető titokzatos hívásokat kap – mindegyik pontosan éjfél után, és mindegyik egy újabb gyilkosságot jósol.", "poster_url" => $basePathToImgs . '/Ejfel_utan.jpg'],
                ["title" => "A Suttogó", "age_limit" => 18, "description" => "A kis faluban mindenki hallott már a suttogásokról – de senki sem beszél róla. Egy fiatal nő visszatér gyermekkora otthonába, ahol az emlékek és a sötétség összefonódnak.", "poster_url" => $basePathToImgs . '/A_suttogo.jpg'],
                ["title" => "Háborgás az Emeleten", "age_limit" => 18, "description" => "Egy régi bérház legfelső emeletéről különös zajok szűrődnek le éjszakánként. Az új lakó csak egy dolgot nem ért=> miért néz rá mindig vissza az a tükör?", "poster_url" => $basePathToImgs . '/Haborgas_az_emeleten.jpg'],
                ["title" => "Fekete Tó", "age_limit" => 18, "description" => "A nyári táborozás pokollá válik, mikor a tó partján különös események kezdődnek. Valami a víz alatt figyel... és sosem jött fel levegőért.", "poster_url" => $basePathToImgs . '/Fekete_to.jpg'],
            ],
        };
    }
    public function createPremierMovies(): void
    {
        $premierMovies = [

            [
                'title' => "NIGHTFIRE: REDEMPTION",
                'description' => "Egy jövőbeli városban, ahol a törvény már csak emlék, egy különleges ügynök szembeszáll a saját múltjával és egy globális tech-kartellel. Drámai megvilágítások, esőáztatta tetők és neonfények között játszódik.",
                'type' => 'action',
                'age_limit' => 14,
                'director' => fake()->firstName() . ' ' . fake()->lastName(),
                'poster_url' => '/img/Main_Slider_img/Nightfire_redemption.webp',
            ],

            [
                'title' => "DUSTZONE: LAST RUN",
                'description' => "A világ romjai között egy utolsó reménysugárként indul el egy életveszélyes konvoj a túlélésért. Sebesség, por, tűz és elkeseredés – egy sivatagi hajszában, ahol nincs második esély.",
                'type' => 'action',
                'age_limit' => 18,
                'director' => fake()->firstName() . ' ' . fake()->lastName(),
                'poster_url' => '/img/Main_Slider_img/Dustzone_last_run.webp',
            ],

            [
                'title' => "REALMSHATTER",
                'description' => "Két világ ütközik egy pontban: a technológia és a mágia határán egy harcos feladata megakadályozni a teljes valóság széthullását. Egy epikus történet dimenziókon átívelő hősökről és sorsokról.",
                'type' => 'action',
                'age_limit' => 16,
                'director' => fake()->firstName() . ' ' . fake()->lastName(),
                'poster_url' => '/img/Main_Slider_img/Realmshatter.webp',
            ]
        ];
        //
        $nextThursday = $this->getNextThursday();
        
        foreach ($premierMovies as $movieData) {
            // Itt megkapja a duration -t, a színészeket, meg a release_date -eket is
            Movie::create([
                'title' => $movieData['title'],
                'description' => $movieData['description'],
                'poster_url' => $movieData['poster_url'],
                'type' => $movieData['type'],
                'director' => $movieData['director'],
                'release_date' => $nextThursday,
                'age_limit' => $movieData['age_limit'],
                'duration_min' => fake()->numberBetween(90, 120), // Premier filmek kicsit legyenek hosszabbak..
                'actors' => $this->generateActors($movieData['type']),
                'is_premier' => true  // !!!
            ]);
        }
    }

    // Ez nézi, hogy az aktuális dátumhoz képest (pl: csütörtök van, akkor KÖVI hét csütörtökre generálja. De ha SZERDA van, akkor mehet "holnapra".),
    // milyen dátummal generálja a `release_date` -eket.

    private function getNextThursday(): Carbon
    {
        $today = Carbon::now();

        if ($today->isThursday()) {
            return $today->next(Carbon::THURSDAY);
        }

        return $today->next(Carbon::THURSDAY);
    }
    // Színészek generálása a filmekhez - Ha nem "rajzfilm" / Animációs
    public function generateActors(string $movieType): array
    {
        if ($movieType !== 'family') {
            return collect(range(1, rand(15, 30)))->map(fn() => fake()->firstName() . ' ' . fake()->lastName())->toArray();
        } else {
            return [];
        }
    }
}
