<?php

namespace Database\Factories;

use App\Models\Screening;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    public function definition(): array
    {
        $screening = Screening::inRandomOrder()->first();
        
        return [
            "user_id" => User::inRandomOrder()->first()->id,
            "confirmation" => bin2hex(random_bytes(12)),
            "location_id" => $screening->drive_in_cinema_id,
            "screening_id"=>$screening->id,
            "parkingspot"=>chr(mt_rand(65, 69)) . mt_rand(1, 8),
            "reserved_at"=>now(),
        ];
    }
}
