<?php

use App\Models\Adopter;
use App\Models\Adoption;
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
    Animal::factory()->create(['status' => 'Disponible']);

    Livewire::test('pages::animal.index')->assertSee('Disponible');
});

it('assert animal file exist', function () {
    Animal::factory()->create(['file' => true]);
    Animal::factory()->create(['file' => false]);

    Livewire::test('pages::animal.index')->assertSee('validée')->assertSee('à valider');
});

it('can retrieve unadopted animals for which there is an interest from an adopter', function () {
    $animals = Animal::factory(5)->create();
    $adopter = Adopter::factory()->create();
    foreach ($animals as $animal) {
        Adoption::create([
            'animal_id' => $animal->id,
            'adopter_id' => $adopter->id,
            'started_at' => \Carbon\Carbon::now(),
        ]);
    }
    expect(Adoption::with('animal')->ongoing()->get()->count())->toBe(5);
//    dd(Adoption::first()->animal->name);
});
