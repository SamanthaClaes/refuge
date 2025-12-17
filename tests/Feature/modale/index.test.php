<?php

use livewire\pages\animal\⚡index\AnimalPages;
use function Pest\Laravel\assertDatabaseHas;

it('open modal on click', function () {

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

