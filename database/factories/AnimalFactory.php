<?php

namespace Database\Factories;

use App\Enums\AnimalStatus;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalFactory extends Factory
{
    protected $model = Animal::class;

    public function definition(): array
    {
        return [
            'name' => fake()->firstName(),

            'specie' => fake()->randomElement([
                'dog',
                'cat',
                'ferret',
                'rat',
                'bunny',
                'birds',
            ]),

            'breed' => fake()->randomElement([
                'Labrador',
                'Golden Retriever',
                'Berger Allemand',
                'Berger Malinois',
                'Maine Coon',
                'Siamois',
                'Lapin Bélier',
                'Canari',
            ]),

            'gender' => fake()->boolean(),

            'description' => fake()->paragraph(),

            'status' => fake()->randomElement([
                AnimalStatus::AVAILABLE,
                AnimalStatus::PENDING,
                AnimalStatus::INCARE,
            ]),

            'age' => fake()->dateTimeBetween('-15 years', '-2 months'),

            'file' => fake()->boolean(80),

            'vaccine' => fake()->boolean(),

            'avatar_path' => fake()->imageUrl(
                width: 400,
                height: 400,
                category: 'animals'
            ),

            'created_by' => User::query()->inRandomOrder()->value('id')
                ?? User::factory(),
        ];
    }

    public function adopted(): static
    {
        return $this->state(fn () => [
            'status' => AnimalStatus::ADOPTED,
        ]);
    }

    public function validated(): static
    {
        return $this->state(fn () => [
            'file' => true,
        ]);
    }

    public function pendingValidation(): static
    {
        return $this->state(fn () => [
            'file' => false,
        ]);
    }
}
