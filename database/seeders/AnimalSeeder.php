<?php

namespace Database\Seeders;

use App\Models\Adoption;
use App\Models\Animal;
use App\Models\AnimalTypes;
use App\Models\Breed;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    public function run(): void
    {
        Animal::factory()->count(30)->create();

        $catType = AnimalTypes::where('name', 'Chat')->first();
        $dogType = AnimalTypes::where('name', 'Chien')->first();

        $maineCoon = Breed::where('name', 'Maine Coon')->first();
        $labrador = Breed::where('name', 'Labrador')->first();

        Animal::factory()->validated()->create([
            'name' => 'Vanille',
            'animal_type_id' => $catType->id,
            'breed_id' => $maineCoon->id,
        ]);

        Animal::factory()->validated()->create([
            'name' => 'Rex',
            'animal_type_id' => $dogType->id,
            'breed_id' => $labrador->id,
        ]);

        Animal::factory()->adopted()->count(5)->create();

        $animals = Animal::all();

        // Adoptions en cours
        foreach ($animals->take(10) as $animal) {
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
