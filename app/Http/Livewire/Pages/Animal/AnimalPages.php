<?php


namespace App\Http\Livewire\Pages\Animal;

use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AnimalPages extends Component
{
    public bool $showCreateAnimalModal = false;
    public bool $showEditAnimalModal = false;
    public string $name = '';
    public string $breed = '';
    public string $species = '';
    public string $age = '';

    #[Computed]
    public function animals()
    {
        return Animal::all();
    }

    public function createAnimalinDB(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|numeric|min:0|max:100',
        ]);

        $age = (int) $this->age;
        Animal::create([
            'name' => $this->name,
            'breed' => $this->breed,
            'specie' => $this->species,
            'age' => $age,
            'status' => 'available',
            'file' => '',
            'vaccine' => false,
            'gender' => true,
        ]);

        session()->flash('message', 'Animal ajouté avec succès !');


        $this->reset(['name', 'breed', 'species', 'age']);


        $this->showCreateAnimalModal = false;
    }


    #[Computed]
    public function adoptions(): Collection
    {
        return Adoption::with('animal')->get();
    }

    #[Computed]
    public function ongoingAdoptions(): Collection
    {
        return Adoption::with('animal')->ongoing()->get();
    }

    #[Computed]
    public function closedAdoptions(): Collection
    {
        return Adoption::with('animal')->finished()->get();
    }

    public function createAnimal(): void
    {
        $this->toggleModal('createAnimal', 'open');
    }

    public function editAnimal(): void
    {
        $this->toggleModal('editAnimal', 'open');
    }


    public function toggleModal($modalType, $action): void
    {
        if ($modalType === 'createAnimal') {
            $this->showCreateAnimalModal = $action === 'open';
            $action === 'open' ? $this->dispatch('open-modal') : $this->dispatch('close-modal');
        } elseif ($modalType === 'editAnimal') {
            $this->showEditAnimalModal = $action === 'open';
            $action === 'open' ? $this->dispatch('open-modal') : $this->dispatch('close-modal');
        }
    }

    public function render()
    {
        return view('livewire.pages.animal.⚡index.animal-pages')
            ->layout('layouts.app');
    }

}
