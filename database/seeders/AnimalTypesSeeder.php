<?php

namespace Database\Seeders;

use App\Models\AnimalTypes;
use Illuminate\Database\Seeder;

class AnimalTypesSeeder extends Seeder
{
    public function run(): void
    {
        {
            foreach ([
                         'Chien',
                         'Chat',
                         'Oiseau',
                         'Lapin',
                         'Rat',
                         'Furet',
                     ] as $type) {
                AnimalTypes::firstOrCreate([
                    'name' => $type,
                ]);
            }
        }
    }
}
