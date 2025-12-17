<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::dashboard-message')
        ->assertStatus(200);
});
