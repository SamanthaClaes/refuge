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
        for ($i = 1; $i <= 28; $i++) {
            Animal::create([
                'name' => 'Animal ' . $i,
                'breed' => 'Inconnu',
                'specie' => 'Chien',
                'gender' => $i % 2 === 0,
                'status' => 'disponible',
                'file' => true,
                'vaccine' => true,
                'description' => 'Animal disponible à l’adoption.',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        Animal::create([
            'name' => 'Chantal',
            'breed' => 'Labrador',
            'specie' => 'Chien',
            'gender' => true,
            'status' => 'en attente',
            'file' => true,
            'vaccine' => true,
            'description' => 'Animal actuellement en attente.',
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Animal::create([
            'name' => 'Tango',
            'breed' => 'Européen',
            'specie' => 'Chat',
            'gender' => false,
            'status' => 'en soins',
            'file' => true,
            'vaccine' => true,
            'description' => 'Animal actuellement en soins.',
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
}
}
