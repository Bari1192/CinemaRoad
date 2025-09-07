<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Screening;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class PurchaseFactory extends Factory
{

    public function definition()
    {
        $isGuest = $this->faker->boolean(50);

        $screening = Screening::inRandomOrder()->first();
        $movie = $screening ? $screening->movie : Movie::inRandomOrder()->first();
        return [
            'screening_id' => $screening->id,
            'movie_id' => $screening->movie_id,
            'location_id' => $screening->drive_in_cinema_id,
            "ticket_code" => bin2hex(random_bytes(12)),
            'parkingspot' => chr(mt_rand(65, 69)) . mt_rand(1, 8),
            'guest_email' => $isGuest ? $this->faker->safeEmail() : null,
            'user_id' => $isGuest ? null : User::inRandomOrder()->first()->id,
        ];
    }
}
