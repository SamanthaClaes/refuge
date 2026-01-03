<?php

namespace Database\Seeders;

use App\Models\Animal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductionAnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $animals = [
            ['name' => 'Moka', 'breed' => 'Labrador', 'specie' => 'Chien'],
            ['name' => 'Luna', 'breed' => 'Siamois', 'specie' => 'Chat'],
            ['name' => 'Rocky', 'breed' => 'Berger', 'specie' => 'Chien'],
            ['name' => 'Tango', 'breed' => 'Européen', 'specie' => 'Chat', 'status'=>'en soins'],

        ];

        foreach (range(1, 30) as $i) {
            $data = $animals[$i % count($animals)];

            Animal::create([
                'name' => $data['name'] . ' ' . $i,
                'breed' => $data['breed'],
                'specie' => $data['specie'],
                'gender' => $i % 2 === 0,
                'status' => 'disponible',
                'file' => true,
                'vaccine' => true,
                'description' => 'Animal disponible à l’adoption.',
                'created_by' => 1,
                'created_at' => now(),
            ]);
        }
    }
}
