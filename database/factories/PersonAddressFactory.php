<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PersonAddress>
 */
class PersonAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cep' => fake()->postcode(),
            'address' => fake()->streetAddress(),
            'number' => fake()->buildingNumber(),
            'adjunct' => fake()->word(),
            'district' => fake()->word(),
            'city' => fake()->city(),
            'state' => fake()->word(),
        ];
    }
}
