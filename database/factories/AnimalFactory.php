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
            'specie'=> $this->faker->randomElement(['dog', 'cat', 'bunny', 'bird']),
            'breed'=>$this->faker->word(),
            'gender'=>$this->faker->boolean(),
            'description'=>$this->faker->sentence('8'),
            'status'=>$this->faker->randomElement(['available', 'on care', 'not available']),
            'age'=>$this->faker->numberBetween(0,15),
            'file'=>$this->faker->boolean(),
            'vaccine'=>$this->faker->boolean(),
            'avatar'=>$this->faker->imageUrl('200','200', 'animals', true),

        ];
    }

    public function withoutName()
    {
        return $this->state(function (array $attributes){
            return[
                'name'=>null
            ];
        });
    }
}
