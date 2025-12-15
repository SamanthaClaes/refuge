<?php


namespace App\Http\Livewire\Pages\Animal;

use App\Jobs\ProcessAnimalAvatar;
use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;


class AnimalPages extends Component
{
    use WithFileUploads;

    public bool $showCreateAnimalModal = false;
    public bool $showEditAnimalModal = false;

    public string $name = '';
    public string $breed = '';
    public string $species = '';
    public int $age = 0;
    public string $status = 'available';
    public bool $vaccine = false;
    public bool $gender = true;
    public $avatar;


    #[Computed]
    public function animals()
    {
        return Animal::all();
    }

    public function createAnimalinDB()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|integer|min:0|max:100',
            'avatar' => 'nullable|image|max:2048',
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

        session()->flash('message', 'Animal ajouté avec succès !');

        $this->reset(['name', 'breed', 'species', 'age', 'avatar']);
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
