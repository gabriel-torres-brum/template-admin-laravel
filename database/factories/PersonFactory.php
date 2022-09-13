<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = fake()->randomElement(['Masculino', 'Feminino']);
        return [
            'name' => fake()->name($gender === 'Masculino' ? 'male' : 'female'),
            'birthday' => fake()->dateTimeBetween('1990-01-01', '2010-12-31')->format('d/m/Y'),
            'gender' => $gender,
            'picture' => fake()->imageUrl(),
            'user_id' => \App\Models\User::factory()
                ->create([
                    'name' => fake()->name(),
                    'email' => 'user_' . fake()->word() . '@email.com',
                ])->id
        ];
    }
}
