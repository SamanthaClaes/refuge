<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LanguageSwitcher extends Component
{
    public bool $open = false;

    public array $languages = [
        'fr' => 'Français',
        'nl' => 'Nederlands',
        'en' => 'English'
    ];

    public function toggle()
    {
        $this->open = !$this->open;
    }

    public function close()
    {
        $this->open = false;
    }

    public function setLanguage(string $lang)
    {
        session(['locale' => $lang]);
        $this->close();

    }

}
