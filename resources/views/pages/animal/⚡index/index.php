<?php

use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public bool $showCreateAnimalModal = false;

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
