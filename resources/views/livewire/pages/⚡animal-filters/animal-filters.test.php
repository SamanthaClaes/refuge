<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::animal-filters')
        ->assertStatus(200);
});
