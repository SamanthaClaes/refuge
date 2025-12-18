<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::lang')
        ->assertStatus(200);
});
