<?php

namespace livewire\pages\⚡lang;

use Livewire\Component;

new class extends Component {
    public bool $open = false;

    public array $languages = [
        'fr' => 'Français',
        'nl' => 'Nederlands',
        'en' => 'English'
    ];

    public function toggle(): void
    {
        $this->open = !$this->open;
    }

    public function close(): void
    {
        $this->open = false;
    }

    public function setLanguage(string $lang): void
    {
        session(['locale' => $lang]);
        $this->close();

    }
};


