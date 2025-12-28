<?php

namespace livewire\pages\⚡dashboard;

use App\Jobs\ProcessAnimalAvatar;
use App\Models\Animal;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;
    public bool $showCreateAnimalModal = false;
    public bool $showEditAnimalModal = false;
    public string $name = '';
    public string $breed = '';
    public string $species = '';
    public string $age = '';
    public string $status = 'available';
    public bool $vaccine = false;
    public bool $gender = true;
    public $avatar;
    public string $searchBar = '';

    #[Computed]
    public function animals(): Collection
    {
        return Animal::query()
            ->when($this->searchBar !== '', function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->searchBar . '%')
                        ->orWhere('breed', 'like', '%' . $this->searchBar . '%')
                        ->orWhere('specie', 'like', '%' . $this->searchBar . '%');
                });
            })
            ->get();
    }
    public function createAnimalinDB(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|numeric|min:0|max:100',
        ]);

        $avatarPath = null;

        if ($this->avatar) {
            $imageType = 'jpg';
            $originalPath = 'avatars/original';
            $fileName = 'avatar_img_' . uniqid() . '.' . $imageType; //
            $avatarPath = $this->avatar->storeAs($originalPath, $fileName, 'public');
            ProcessAnimalAvatar::dispatch($fileName, $avatarPath);
        }

        Animal::create([
            'name' => $this->name,
            'breed' => $this->breed,
            'specie' => $this->species,
            'age' => $this->age,
            'status' => $this->status,
            'vaccine' => $this->vaccine,
            'gender' => $this->gender,
            'avatar_path' => $avatarPath,
            'file' => $avatarPath ?? '',
        ]);

        $age = (int) $this->age;
        Animal::create([
            'name' => $this->name,
            'breed' => $this->breed,
            'specie' => $this->species,
            'age' => $age,
            'status' => $this->status,
            'file' => '',
            'vaccine' => $this->vaccine,
            'gender' => $this->gender,
        ]);



        session()->flash('message', 'Animal ajouté avec succès !');


        $this->reset(['name', 'breed', 'species', 'age']);


        $this->showCreateAnimalModal = false;
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

    


};
