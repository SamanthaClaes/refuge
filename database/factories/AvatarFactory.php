<?php

namespace Database\Factories;

use App\Models\Avatar;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AvatarFactory extends Factory
{
    protected $model = Avatar::class;

    public function definition(): array
    {
        return [
            'avatar' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
