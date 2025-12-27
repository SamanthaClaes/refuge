<?php

use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test('pages::lang')
        ->assertStatus(200);
});

it('show volunteer name on page', function () {
    \App\Models\User::factory()->create(['name'=>'chloé']);
    Livewire::test('pages::volunteer')->assertSee('chloé');
});
