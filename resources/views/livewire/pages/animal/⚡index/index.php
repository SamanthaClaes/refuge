<?php


namespace livewire\pages\animal\⚡index;

use App\Jobs\ProcessAnimalAvatar;
use App\Mail\AnimalCreatedMail;
use App\Models\Adoption;
use App\Models\Animal;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


new class extends Component {
    use WithFileUploads;
    use WithPagination;

    public ?int $animalId = null;

    public bool $showCreateAnimalModal = false;
    public bool $showEditModal = false;
    public string $name = '';
    public string $breed = '';
    public string $specie = '';
    public string $description = '';
    public ?string $age = null;
    public string $status = 'disponible';

    public bool $vaccine = false;
    public bool $gender = true;
    public $avatar;
    public Animal $animal;
    public array $avatar_path = [];
    public ?string $adoptionStartDate = null;
    public ?string $adoptionClosedAt = null;
    public ?int $adoptionId = null;


    #[Computed]
    public function animals()
    {
        return Animal::query()
            ->where(function ($q) {
                $q->where('file', true)
                    ->where('status', 'disponible')
                    ->whereDoesntHave('adoptions', fn ($q) => $q->ongoing());
            })
            ->orWhere('created_by', auth()->id())
            ->latest()
            ->paginate(10);
    }


    public function createAnimalinDB(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'specie' => 'required|string|max:255',
            'age' => 'nullable|date|before_or_equal:today',
            'status' => 'required|in:disponible,en attente,en soins,adopté(e)',
            'gender' => 'required|boolean',
            'vaccine' => 'boolean',
            'adoptionStartDate' => 'nullable|date_format:Y-m-d',
            'adoptionClosedAt' => 'nullable|date_format:Y-m-d|after_or_equal:adoptionStartDate',
        ]);
        $avatarPath = null;
        $status = $this->status;
        if ($this->adoptionStartDate && !$this->adoptionClosedAt) {
            $status = 'en attente';
        } elseif ($this->adoptionClosedAt) {
            $status = 'adopté(e)';
        }
        $animal = Animal::create([
            'name' => $this->name,
            'breed' => $this->breed,
            'specie' => $this->specie,
            'age' => $this->age ?: null,
            'status' => $status,
            'vaccine' => $this->vaccine,
            'gender' => $this->gender,
            'description' => $this->description,
            'avatar_path' => $avatarPath,
            'file' => false,
            'created_by' => auth()->id(),
        ]);
        if ($this->avatar) {
            $imageType = 'jpg';
            $originalPath = 'avatars/original';
            $fileName = 'avatar_img_' . uniqid() . '.' . $imageType;

            $avatarPath = $this->avatar->storeAs($originalPath, $fileName, 'public');

            $animal->update([
                'avatar_path' => $avatarPath,
            ]);

            ProcessAnimalAvatar::dispatch($fileName, $avatarPath);
        }
        $this->resetPage();
        foreach ($this->avatar_path as $file) {
        $path = $file->store('avatars', 'public');

        $animal->avatars()->create([
            'path' => $path,
            'description' => null,
        ]);
    }

        if ($this->adoptionStartDate) {
            Adoption::create([
                'animal_id' => $animal->id,
                'started_at' => Carbon::parse($this->adoptionStartDate),
                'closed_at' => $this->adoptionClosedAt ? Carbon::parse($this->adoptionClosedAt) : null,
            ]);
        }

        $this->description = $animal->description;
        session()->flash('message', 'Animal ajouté avec succès !');
         Mail::to(auth()->user()->email)
              ->queue(new AnimalCreatedMail($animal));

        $this->description = $animal->description;
        $this->showCreateAnimalModal = false;
        $this->reset([
            'name',
            'breed',
            'specie',
            'description',
            'age',
            'status',
            'vaccine',
            'gender',
            'avatar',
            'avatar_path',
            'adoptionStartDate',
            'adoptionClosedAt',
            'animalId',
        ]);

    }


    #[Computed]
    public function adoptions(): Collection
    {
        return Adoption::with('animal')->get();
    }

    #[Computed]
    public function ongoingAdoptions(): Collection
    {
        return Adoption::with('animal')
            ->whereHas('animal')
            ->ongoing()
            ->get();
    }

    #[Computed]
    public function oncareAnimals(): Collection
    {

        return Animal::where('status', 'en soins')->get();
    }

    #[Computed]
    public function closedAdoptions(): Collection
    {
        return Adoption::with('animal')
        ->whereHas('animal')
        ->finished()
        ->get();
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
        $this->age = $animal->age?->format('Y-m-d');
        $this->status = $animal->status;
        $this->vaccine = (bool)$animal->vaccine;
        $this->description = $animal->description;

        $adoption = Adoption::where('animal_id', $animal->id)->first();
        if ($adoption) {
            $this->adoptionStartDate = $adoption->started_at?->format('Y-m-d');
            $this->adoptionClosedAt = $adoption->closed_at?->format('Y-m-d');
            $this->adoptionId = $adoption->id;
        }

        $this->toggleModal('openEditModal', 'open');
    }

    public function editAnimal(): void
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'specie' => 'required|string|max:255',
            'age' => 'nullable|date|before_or_equal:today',
            'status' => 'required|string',
            'vaccine' => 'required|boolean',
            'description' => 'nullable|string',
            'gender' => 'required|boolean',
            'avatar_path.*' => 'image|max:2048',
        ]);

        $animal = Animal::findOrFail($this->animalId);

        if ($this->avatar) {
            $fileName = 'avatar_img_' . uniqid() . '.jpg';
            $avatarPath = $this->avatar->storeAs('avatars/original', $fileName, 'public');

            ProcessAnimalAvatar::dispatch($fileName, $avatarPath);

            $validated['avatar_path'] = $avatarPath;
            $validated['file'] = $avatarPath;
        }

        unset($validated['avatar']);
        $animal->update($validated);
        $adoption = Adoption::where('animal_id', $animal->id)->first();

        if ($this->adoptionStartDate) {
            if ($adoption) {
                $adoption->update([
                    'started_at' => $this->adoptionStartDate,
                    'closed_at' => $this->adoptionClosedAt,
                ]);
            } else {
                Adoption::create([
                    'animal_id' => $animal->id,
                    'started_at' => $this->adoptionStartDate,
                    'closed_at' => $this->adoptionClosedAt,
                ]);
            }
        } elseif ($adoption) {
            $adoption->delete();
        }
        $this->showEditModal = false;
        $this->reset([
            'name',
            'breed',
            'specie',
            'description',
            'age',
            'status',
            'vaccine',
            'gender',
            'avatar',
            'avatar_path',
            'adoptionStartDate',
            'adoptionClosedAt',
            'animalId',
        ]);


        session()->flash('message', 'Animal modifié avec succès!');
    }

    public function toggleModal($modalType, $action): void
    {
        if ($modalType === 'createAnimal') {
            $this->showCreateAnimalModal = $action === 'open';
        }

        if ($modalType === 'openEditModal') {
            $this->showEditModal = $action === 'open';
        }
    }

    public function render()
    {
        return view('livewire.pages.animal.⚡index.index')
            ->title('Animaux-Dashboard');
    }

    public function deleteAnimal(int $animalId): void
    {
        $animal = Animal::findOrFail($animalId);
        $animal->delete();
    }
};
