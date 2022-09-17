<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EcclesiasticalRole>
 */
class EcclesiasticalRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->word() . fake()->word(),
            'gender' => fake()->randomElement(['Masculino', 'Feminino'])
        ];
    }
}
