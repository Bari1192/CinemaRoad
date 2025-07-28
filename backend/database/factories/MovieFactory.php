<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{

    public function definition(): array
    {
        $movieTypes = fake()->randomElement(["horror", "family", "action"]);

        return [
            // 'title' => fake()->text(),
            // 'type' => $movieTypes,
            'description' => fake()->paragraph(),
            'duration_min' => fake()->numberBetween(60, 90),
            // 'poster_url' => "https://example.com/%7B$movieTypes%7D_poster.jpg"
        ];
    }
}
