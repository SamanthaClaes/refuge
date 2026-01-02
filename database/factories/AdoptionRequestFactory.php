<?php

namespace Database\Factories;

use App\Models\AdoptionRequest;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AdoptionRequestFactory extends Factory
{
    protected $model = AdoptionRequest::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
