<?php

use App\Models\Animal;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::animal.index')
        ->assertStatus(200);
});

it('assert animal name exist', function () {
    Animal::factory()->create(['name' => 'Stuart']);
    Animal::factory()->create(['name' => 'Rex']);

    Livewire::test('pages::animal.index')->assertSee('Rex')->assertSee('Stuart');
});

it('assert animal race exist', function () {
    Animal::factory()->create(['race' => 'Berger Allemand']);
    Animal::factory()->create(['race' => 'Berger Malinois']);

    Livewire::test('pages::animal.index')->assertSee('Berger Allemand')->assertSee('Berger Malinois');
});

it('assert animal gender exist', function () {
    Animal::factory()->create(['gender' => true]);
    Animal::factory()->create(['gender' => false]);

    Livewire::test('pages::animal.index')->assertSee('Mâle')->assertSee('Femelle');
});

it('assert animal status exist', function () {
    Animal::factory()->create(['status'=>'Disponible']);

    Livewire::test('pages::animal.index')->assertSee('Disponible');
});

it('assert animal file exist', function () {
    Animal::factory()->create(['file'=>true]);
    Animal::factory()->create(['file'=>false]);

    Livewire::test('pages::animal.index')->assertSee('validée')->assertSee('à valider');
});
