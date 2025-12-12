<?php

use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{

    #[Computed]
    public function pets()
    {
        return auth()->user()->pets()->where('name', 'like', '%' . $this->term. '%')->get();
    }
};
