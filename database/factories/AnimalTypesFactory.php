<?php

namespace Database\Factories;

use App\Models\AnimalTypes;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AnimalTypesFactory extends Factory
{
    protected $model = AnimalTypes::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
