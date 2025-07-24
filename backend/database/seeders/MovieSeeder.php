<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        DB::table("movies")->insert([
            [
                'title' => 'The Grand Adventure',
                'description' => 'A thrilling journey across lands unknown.',
                'type' => 'family',
                'duration_min' => 150,
                'poster_url' => 'https://www.mafab.hu/static/2017/248/15/279655_1504704859.7754.jpg',
            ],
            [
                'title' => 'Comedy Night Live',
                'description' => 'Laugh out loud with stand-up comedians.',
                'type' => 'action',
                'duration_min' => 90,
                'poster_url' => 'https://media.posterstore.com/site_images/67a5dd135d8e0ac409209fac_WB0101-8.jpg?auto=compress%2Cformat&fit=max&w=3840',
            ],
            [
                'title' => 'Comedy Rage Night',
                'description' => 'Laugh out loud with stand-up comedians.',
                'duration_min' => 90,
                'type' => 'horror',
                'poster_url' => 'https://dp8ij3ml0f16h.cloudfront.net/s3_files/styles/facebook/s3/film/plakat/halalos_iramban_hobbs_shaw_intl_pl_hun_m.jpg.webp?itok=F01ohnrI',
            ]
        ]);
    }
}
