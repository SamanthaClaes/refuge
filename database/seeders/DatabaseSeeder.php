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

        User::firstOrCreate(
            ['email' => 'elise@mail.be'],
            [
                'name' => 'Elise',
                'password' => 'test',
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
        User::firstOrCreate(
            ['email' => 'thomas@mail.be'],
            [
                'name' => 'Thomas',
                'password' => 'test',
                'role' => 'volunteer',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'chloe@mail.be'],
            [
                'name' => 'Chloé',
                'password' => 'test',
                'role' => 'volunteer',
                'email_verified_at' => now(),
            ]
        );

    }
}
