<?php

use App\Http\Livewire\Pages\Animal\AnimalPages;
use App\Models\Animal;
use function Pest\Laravel\assertDatabaseHas;

it('open modal on click', function () {
    $animal = Animal::factory()->create();

    Livewire::test(AnimalPages::class)
        ->set('showCreateAnimalModal', true)
        ->set('name', 'Rex')
        ->set('breed', 'Labrador')
        ->set('species', 'chien')
        ->set('age', 5)
        ->call('createAnimalinDB')
        ->assertHasNoErrors()
        ->assertSet('showCreateAnimalModal', false);

    assertDatabaseHas('animals', [
        'name' => 'Rex',
        'specie' => 'chien',
        'age' => 5,
    ]);
});

