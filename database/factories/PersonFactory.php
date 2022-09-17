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
            'gender' => $gender,
            'birthday' => fake()->dateTimeBetween('1990-01-01', '2010-12-31')->format('d/m/Y'),
            'marital_status' => fake()->randomElement(['Solteiro(a)', 'Casado(a)']),
            'birthplace' => fake()->city(),
            'is_baptized' => fake()->boolean(70),
            'is_tither' => fake()->boolean(),
            'is_in_discipline' => fake()->boolean(90),
            'father_name' => fake()->name('male'),
            'mother_name' => fake()->name('female'),
            'baptism_date' => fake()->date('d/m/Y'),
            'receipt_date' => fake()->date('d/m/Y'),
            'affiliation_date' => fake()->date('d/m/Y'),
            'church_from' => fake()->company(),
            'picture' => fake()->imageUrl(),
            'user_id' => null,
            'ecclesiastical_role_id' => \App\Models\EcclesiasticalRole::factory()
                ->create()->id
        ];
    }
}
