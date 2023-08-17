<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

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
        $faker = Faker::create('id_ID');
        $harga = $faker->randomNumber(5,true);
        $harga2 = $faker->randomNumber(6,true);
        return [
            'nama'=>$faker->word(),
            'qty'=>$faker->randomDigit(),
            'hargaPerolehan'=>$harga,
            'hargaPenjualan'=>$harga2,
            'untung'=>$harga2- $harga,
            'barqode'=>$faker->ean13()
        ];
    }
}
