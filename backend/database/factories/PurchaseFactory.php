<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Database\Eloquent\Factories\Factory;


class PurchaseFactory extends Factory
{

    public function definition()
    {
        $screening = Screening::inRandomOrder()->first();
        $movie = $screening ? $screening->movie : Movie::inRandomOrder()->first();
        return [
            'screening_id' => $screening->id,
            'movie_id' => $screening->movie_id,
            'location_id' => $screening->drive_in_cinema_id,
            "ticket_code" => bin2hex(random_bytes(12)),
            'guest_email' => $this->faker->optional()->safeEmail,
            'parkingspot' => chr(mt_rand(65, 69)) . mt_rand(1, 8),
        ];
    }
}
