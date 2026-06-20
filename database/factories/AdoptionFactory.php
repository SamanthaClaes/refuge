<?php

namespace Database\Factories;

use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdoptionFactory extends Factory
{
    protected $model = Adoption::class;

    public function definition(): array
    {
        return [
            'started_at' => fake()->dateTimeBetween('-2 months', 'now'),
            'closed_at' => null,
            'adopter_id' => null,
            'animal_id' => Animal::factory(),
        ];
    }

    public function finished(): static
    {
        return $this->state(fn () => [
            'started_at' => fake()->dateTimeBetween('-6 months', '-3 months'),
            'closed_at' => fake()->dateTimeBetween('-2 months', 'now'),
        ]);
    }
}
