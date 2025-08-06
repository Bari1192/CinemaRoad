<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActorsFactory extends Factory
{
    public function definition(): array
    {
        $name=fake()->firstName().' '. fake()->lastName();
        return [
            //
        ];
    }
}
