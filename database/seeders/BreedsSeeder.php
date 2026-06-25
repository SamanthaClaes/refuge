<?php

namespace Database\Seeders;

use App\Models\AnimalTypes;
use App\Models\Breed;
use Illuminate\Database\Seeder;

class BreedsSeeder extends Seeder
{
    public function run(): void
    {
        $breeds = [
            'Chien' => [
                'Labrador',
                'Golden Retriever',
                'Berger Allemand',
                'Berger Malinois',
                'Border Collie',
            ],
            'Chat' => [
                'Maine Coon',
                'Siamois',
                'Persan',
                'Bengal',
                'Ragdoll',
            ],
            'Oiseau' => [
                'Canari',
                'Perruche',
                'Calopsitte',
                'Inséparable',
                'Diamant Mandarin',
            ],
            'Lapin' => [
                'Bélier',
                'Nain Hollandais',
                'Rex',
                'Angora',
                'Géant des Flandres',
            ],
            'Rat' => [
                'Dumbo',
                'Berkshire',
                'Bleu Russe',
                'Albinos',
                'Irish',
            ],
            'Furet' => [
                'Standard',
                'Angora',
                'Panda',
                'Sable',
                'Albinos',
            ],
        ];

        foreach ($breeds as $animalTypeName => $breedNames) {
            $animalType = AnimalTypes::where('name', $animalTypeName)->firstOrFail();

            foreach ($breedNames as $breedName) {
                Breed::firstOrCreate([
                    'name' => $breedName,
                    'animal_type_id' => $animalType->id,
                ]);
            }
        }
    }
}
