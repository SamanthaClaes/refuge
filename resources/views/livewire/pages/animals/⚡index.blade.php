<?php

use App\Enums\AnimalStatus;
use App\Jobs\ProcessAnimalAvatar;
use App\Mail\AnimalCreatedMail;
use App\Models\Adoption;
use App\Models\Animal;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

new #[Title('Animals | Dashboard')]
class extends Component {
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
    public string $search = '';

    public bool $vaccine = false;
    public bool $gender = true;
    public $avatar;
    public Animal $animal;
    public array $avatar_path = [];
    public ?string $adoptionStartDate = null;
    public ?string $adoptionClosedAt = null;
    public ?int $adoptionId = null;

    #[Computed]
    public function animals(): LengthAwarePaginator
    {
        return Animal::query()
            ->where('status', '!=', AnimalStatus::ADOPTED)
            ->when($this->search, function ($query) {
                $query->where('name', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(5);
    }
    public function updatedSearchBar(): void
    {
        $this->resetPage();
    }

    public function storeAnimal(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'specie' => 'required|string|max:255',
            'age' => 'nullable|date|before_or_equal:today',
            'status' => 'required',
            'gender' => 'required|boolean',
            'vaccine' => 'boolean',
            'adoptionStartDate' => 'nullable|date_format:Y-m-d',
            'adoptionClosedAt' => 'nullable|date_format:Y-m-d|after_or_equal:adoptionStartDate',
        ]);
        $avatarPath = null;
        $status = $this->status;
        if ($this->adoptionStartDate && !$this->adoptionClosedAt) {
            $status = AnimalStatus::PENDING;
        } elseif ($this->adoptionClosedAt) {
            $status = AnimalStatus::ADOPTED;
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
        $this->resetForm();
        $this->dispatch('animal-created');
    }

    #[Computed]
    public function adoptions(): Collection
    {
        return Adoption::with('animal')->get();
    }

    #[Computed]
    public function ongoingAdoptions(): LengthAwarePaginator
    {
        return Adoption::with('animal')
            ->whereHas('animal')
            ->ongoing()
            ->latest()
            ->paginate(5);
    }
    #[Computed]
    public function oncareAnimals(): LengthAwarePaginator
    {

        return Animal::where('status', AnimalStatus::INCARE)
            ->paginate(5);
    }

    #[Computed]
    public function closedAdoptions(): LengthAwarePaginator
    {
        return Adoption::with('animal')
            ->whereHas('animal')
            ->finished()
            ->paginate(5);
    }

    public function openCreateModal(): void
    {
        $this->resetForm();
        $this->dispatch('open-create-modal');
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
        $this->resetForm();
        $this->dispatch('animal-edited');
        session()->flash('message', 'Animal modifié avec succès!');
    }

    public function openEditModal(int $animalId): void
    {
        $animal = Animal::with('adoptions')->findOrFail($animalId);

        $this->animalId = $animal->id;
        $this->name = $animal->name;
        $this->breed = $animal->breed;
        $this->specie = $animal->specie;
        $this->description = $animal->description ?? '';
        $this->age = $animal->age?->format('Y-m-d');
        $this->status = $animal->status;
        $this->vaccine = $animal->vaccine;
        $this->gender = $animal->gender;

        $adoption = $animal->adoptions()->first();

        $this->adoptionStartDate = $adoption?->started_at?->format('Y-m-d');
        $this->adoptionClosedAt = $adoption?->closed_at?->format('Y-m-d');

        $this->dispatch('open-edit-modal');
    }

    public function deleteAnimal(int $animalId): void
    {
        $animal = Animal::findOrFail($animalId);
        $animal->delete();
    }

    public function resetForm(): void
    {
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
};

?>

<div>
    <main class="bg-background">
        <x-header.search-bar/>
        <div class="pl-72 pr-12 grid grid-cols-12 gap-4">
            <section class="row-start-2 col-span-12">
                <h1 class="sr-only">Liste de tous les animaux</h1>
                <div class="flex justify-between items-center">
                    <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste de tous les animaux</h2>
                    <x-cta.add title="+ Ajouter un animal"/>
                </div>
                <x-table.animalTables.allAnimals_table
                    :animals="$this->animals"
                />
                <div class="flex justify-between items-center mt-8">
                    <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste des animaux en cours d’adoption</h2>
                </div>
                    <x-table.animalTables.onGoingAdoption
                        :adoptions="$this->ongoingAdoptions"
                    />
                <section>
                    <div class="flex justify-between items-center mt-8">
                        <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste des animaux en soins</h2>
                    </div>
                </section>
                <x-table.animalTables.onCareAnimals
                    :animals="$this->oncareAnimals"
                />
                <div class="flex justify-between items-center mt-8">
                    <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste des animaux adoptés</h2>
                </div>
                <x-table.animalTables.closeAdoption
                    :adoptions="$this->closedAdoptions"
                />
            </section>
        </div>
        <x-modals.createAnimal_modal/>
        <x-modals.editAnimal_modal/>
    </main>
</div>
