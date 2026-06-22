<?php

namespace Database\Seeders;

use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    public function run(): void
    {
        Animal::factory()->count(30)->create();

        Animal::factory()->validated()->create([
            'name' => 'Vanille',
            'specie' => 'cat',
        ]);

        Animal::factory()->validated()->create([
            'name' => 'Rex',
            'specie' => 'dog',
        ]);

        Animal::factory()->adopted()->count(5)->create();

        $animals = Animal::all();

        // Adoptions en cours
        foreach ($animals->take(5) as $animal) {
            Adoption::factory()->create([
                'animal_id' => $animal->id,
            ]);
        }

        // Adoptions terminées
        foreach ($animals->skip(5)->take(5) as $animal) {
            Adoption::factory()->finished()->create([
                'animal_id' => $animal->id,
            ]);
        }
    }
}
