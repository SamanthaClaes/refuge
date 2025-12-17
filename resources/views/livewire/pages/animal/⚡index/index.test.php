<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::animal.index')
        ->assertStatus(200);
});
