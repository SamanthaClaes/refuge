<?php

namespace Database\Seeders;

use App\Models\Adopter;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name'=>'Elise',
            'email' => 'elise@mail.be',
            'password' => 'test',
        ]);

        Animal::factory(5)->create();
        Adopter::factory(2)->create();
    }
}
