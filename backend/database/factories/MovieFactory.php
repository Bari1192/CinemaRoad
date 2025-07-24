<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $movieTypes = $this->faker->randomElement(["horror", "family", "action"]);

        return [
            'title' => $this->faker->catchPhrase(),
            'type' => $movieTypes,
            'description' => $this->faker->paragraph(),
            'duration_min' => $this->faker->numberBetween(60, 90),
            'poster_url' => "https://example.com/{$movieTypes}_poster.jpg"    
        ];
    }
}
