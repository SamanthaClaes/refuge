<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages:contact-form')
        ->assertStatus(200);
});
