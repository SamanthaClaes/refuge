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
            [
                'email' => 'elise@mail.be',
                'name' => 'Elise',
                'phone' => '0499000001',
                'password' => 'test',
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
        User::firstOrCreate(
            [
                'email' => 'thomas@mail.be',
                'name' => 'Thomas',
                'phone' => '0499000002',
                'password' => 'test',
                'role' => 'volunteer',
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            [
                'email' => 'chloe@mail.be',
                'name' => 'Chloé',
                'phone' => '0499000003',
                'password' => 'test',
                'role' => 'volunteer',
                'email_verified_at' => now(),
            ]
        );

    }
}
