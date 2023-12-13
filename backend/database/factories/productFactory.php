<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "barqode"=> fake()->randomDigit(),
            "name" => fake()->name(),
            "qty" => fake()->randomNumber(),
            "price" => fake()->randomNumber(),
            "profit" => fake()->randomNumber(),
        ];
    }
}
