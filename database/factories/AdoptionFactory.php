<?php

namespace Database\Factories;

use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AdoptionFactory extends Factory
{
    protected $model = Adoption::class;

    public function definition(): array
    {
        return [
            'started_at' => Carbon::now(),
            'adopter_id' => $this->faker->randomNumber(),
            'closed_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'animal_id' => Animal::factory(),
        ];
    }
}
