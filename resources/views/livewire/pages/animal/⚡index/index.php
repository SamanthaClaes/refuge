<?php


namespace livewire\pages\animal\⚡index;

use App\Jobs\ProcessAnimalAvatar;
use App\Models\Adoption;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;


new class extends Component {
    use WithFileUploads;

    public ?int $animalId = null;

    public bool $showCreateAnimalModal = false;
    public bool $showEditModal = false;
    public string $name = '';
    public string $breed = '';
    public string $species = '';
    public string $description = '';
    public ? string $age = null;
    public string $status = 'disponible';

    public bool $vaccine = false;
    public bool $gender = true;
    public $avatar;
    public array $avatar_path = [];


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
            'age' => 'before_or_equal:today',
            'status' => 'required|string|max:255',
            'gender' => 'required|boolean',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $avatarPath = null;

        if ($this->avatar) {
            $imageType = 'jpg';
            $originalPath = 'avatars/original';
            $fileName = 'avatar_img_' . uniqid() . '.' . $imageType;
            $avatarPath = $this->avatar->storeAs($originalPath, $fileName, 'public');
            ProcessAnimalAvatar::dispatch($fileName, $avatarPath);
        }

        $animal = Animal::create([
            'name' => $this->name,
            'breed' => $this->breed,
            'specie' => $this->species,
            'age' => $this->age,
            'status' => $this->status,
            'vaccine' => $this->vaccine,
            'gender' => $this->gender,
            'description' => $this->description,
            'avatar_path' => $avatarPath,
            'file' => $avatarPath ?? '',
        ]);

        foreach ($this->avatar_path as $file) {
            $path = $file->store('avatars', 'public');

            $animal->avatars()->create([
                'path' => $path,
                'description' => null,
            ]);
        }
        $this->description = $animal->description;
        session()->flash('message', 'Animal ajouté avec succès !');

        $this->reset(['name', 'breed', 'species', 'age', 'avatar', 'avatar_path']);
        $this->description = $animal->description;
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

    public function openEditModal($animalId): void
    {
        $animal = Animal::findOrFail($animalId);
        $this->animalId = $animal->id;
        $this->name = $animal->name;
        $this->breed = $animal->breed;
        $this->gender = (bool)$animal->gender;
        $this->species = $animal->specie;
        $this->age = $animal->age->format('Y-m-d');
        $this->status = $animal->status;
        $this->vaccine = (bool)$animal->vaccine;
        $this->description = $animal->description;

        $this->toggleModal('openEditModal', 'open');
    }

    public function editAnimal(): void
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'species' => 'required|string|max:255',
            'age' => 'required|date|before_or_equal:today',
            'status' => 'required|string',
            'vaccine' => 'required|boolean',
            'description' => 'nullable|string',
            'gender' => 'required|boolean:',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $animal = Animal::findOrFail($this->animalId);

        if ($this->avatar) {
            $fileName = 'avatar_img_' . uniqid() . '.jpg';
            $avatarPath = $this->avatar->storeAs('avatars/original', $fileName, 'public');

            ProcessAnimalAvatar::dispatch($fileName, $avatarPath);

            $validated['avatar_path'] = $avatarPath;
            $validated['file'] = $avatarPath;
        }

        $validated['specie'] = $validated['species'];
        unset($validated['species'], $validated['avatar']);
        $animal->update($validated);
        $this->showEditModal = false;
        $this->reset(['name', 'breed', 'species', 'age', 'vaccine', 'gender', 'avatar', 'animalId']);

        session()->flash('message', 'Animal modifié avec succès!');
    }

    public function toggleModal($modalType, $action): void
    {
        if ($modalType === 'createAnimal') {
            $this->showCreateAnimalModal = $action === 'open';
            $action === 'open' ? $this->dispatch('open-modal') : $this->dispatch('close-modal');
        } elseif ($modalType === 'openEditModal') {
            $this->showEditModal = $action === 'open';
            $action === 'open' ? $this->dispatch('open-modal') : $this->dispatch('close-modal');
        }
    }

    public function show(Animal $animal)
    {
        $animal = Animal::all();
        return view('animals.show', compact('animal'));
    }
};
