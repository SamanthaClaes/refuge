<?php


namespace livewire\pages\animal\⚡index;

use App\Jobs\ProcessAnimalAvatar;
use App\Models\Adoption;
use App\Models\Animal;
use Carbon\Carbon;
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
    public string $specie = '';
    public string $description = '';
    public ?string $age = null;
    public string $status = '';

    public bool $vaccine = false;
    public bool $gender = true;
    public $avatar;
    public array $avatar_path = [];
    public ?string $adoptionStartDate = null;
    public ?string $adoptionClosedAt = null;
    public ?int $adoptionId = null;


    #[Computed]
    public function animals()
    {
        return Animal::whereNot('status', 'adopté(e)')->get();
    }

    public function createAnimalinDB()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'specie' => 'required|string|max:255',
            'age' => 'before_or_equal:today',
            'gender' => 'required|boolean',
            'avatar' => 'nullable|image|max:2048',
            'adoptionStartDate' => 'nullable|date',
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
            'specie' => $this->specie,
            'age' => $this->age ? Carbon::createFromFormat('d/m/Y', $this->age)->format('Y-m-d') : null,
            'status' => $this->adoptionStartDate ? 'en attente' : 'disponible',
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

        $this->description = $animal->description;
        $this->showCreateAnimalModal = false;
        $this->reset(['name', 'breed', 'specie', 'age', 'vaccine', 'gender', 'avatar', 'animalId', 'description']);
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
    public function oncareAdoption(): Collection
    {
        return Adoption::with('animal')->onCare()->get();
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
        $this->specie = $animal->specie;
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
            'specie' => 'required|string|max:255',
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

        unset($validated['specie'], $validated['avatar']);
        $animal->update(['status' => $this->status]);
        $animal->update($validated);
        $this->showEditModal = false;
        $this->reset(['name', 'breed', 'specie', 'age', 'vaccine', 'gender', 'avatar', 'animalId', 'description']);

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
