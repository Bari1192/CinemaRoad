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
                'poster_url' => 'https://example.com/adventure_poster.jpg',
            ],
            [
                'title' => 'Comedy Night Live',
                'description' => 'Laugh out loud with stand-up comedians.',
                'type' => 'action',
                'duration_min' => 90,
                'poster_url' => 'https://example.com/comedy_poster.jpg',
            ],
            [
                'title' => 'Comedy Rage Night',
                'description' => 'Laugh out loud with stand-up comedians.',
                'duration_min' => 90,
                'type' => 'horror',
                'poster_url' => 'https://example.com/comedy_poster.jpg',
            ]
        ]);
    }
}
