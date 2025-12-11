<?php

use App\Models\Animal;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {

    public bool $showCreateAnimalModal = false;

    #[Computed]
    public function animals()
    {
        return Animal::all();
    }

    public function createAnimal(): void
    {
        $this->openModal('createAnimal');
    }

    public function openModal($modalType): void
    {
        if ($modalType === 'createAnimal') {
            $this->showCreateAnimalModal = true;
            $this->dispatch('open-modal');
        }
    }

    public function closeModal($modalType): void
    {
        if ($modalType === 'createAnimal') {
            $this->showCreateAnimalModal = false;
            $this->dispatch('close-modal');
        }
    }
};
