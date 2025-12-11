<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> $this->faker->firstName(),
            'specie'=> $this->faker->randomElement(['chien', 'chat', 'lapin', 'oiseaux']),
            'race'=>$this->faker->word(),
            'gender'=>$this->faker->boolean(),
            'description'=>$this->faker->sentence('8'),
            'status'=>$this->faker->randomElement(['disponible', 'en soins', 'pas disponible']),
            'age'=>$this->faker->dateTimeBetween('-10 years', 'now'),
            'file'=>$this->faker->boolean(),
            'vaccine'=>$this->faker->boolean(),
            'avatar'=>$this->faker->imageUrl('200','200', 'animals', true),
        ];
    }
}
