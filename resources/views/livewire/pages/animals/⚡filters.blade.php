<?php

use App\Enums\AnimalStatus;
use App\Models\Animal;
use App\Models\AnimalTypes;
use App\Models\Breed;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public $animalType = '';
    public $breed = '';
    public $age = '';
    public $pelage = '';
    public string $sortColumn = 'name';
    public string $sortDirection = 'asc';
    protected string $paginationTheme = 'tailwind';
    public $status = '';


    #[Computed]
    public function animals(): LengthAwarePaginator
    {
        return Animal::query()
            ->where('status', '!=', AnimalStatus::ADOPTED)
            ->when($this->age, fn($q) => $q->where('age', $this->age))
            ->when($this->animalType, fn($q) => $q->where('animal_type_id', $this->animalType))
            ->when($this->breed, fn($q) => $q->where('breed_id', $this->breed))
            ->when($this->pelage, fn($q) => $q->where('pelage', $this->pelage))
            ->when($this->status, fn ($q) => $q->where('status', $this->status))
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate(9);

    }

    #[Computed]
    public function availableBreeds(): Collection
    {
        return Breed::query()
            ->when(
                $this->animalType,
                fn($query) => $query->where('animal_type_id', $this->animalType)
            )
            ->orderBy('name')
            ->get();
    }

    #[Computed]
    public function animalTypes(): Collection
    {
      return AnimalTypes::query()->orderBy('name')->get();
    }

    public function sortBy(string $column, string $direction): void
    {
        $this->sortColumn = $column;
        $this->sortDirection = $direction;
    }
};
?>

<div>
    <div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-6 lg:ml-40 lg:mr-20 lg:mb-20 pb-3">

            <div class="col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
                <label class="pl-1" for="specie">{{ __('animals.specie') }}</label>
                <select wire:model.live="animalType" id="specie" class="bg-element rounded-lg p-3 w-full mt-1">
                    <option value="">{{ __('animals.select_specie') }}</option>
                    @foreach($this->animalTypes as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
                <label class="pl-1" for="breed">{{ __('animals.breed') }}</label>
                <select wire:model.live="breed" id="breed" class="bg-element rounded-lg p-3 w-full mt-1">
                    <option value="">{{ __('animals.select_breed') }}</option>
                    @foreach($this->availableBreeds as $breed)
                        <option value="{{ $breed->id }}">
                            {{ $breed->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
                <label class="pl-1" for="status">Statut</label>

                <select
                    wire:model.live="status"
                    id="status"
                    class="bg-element rounded-lg p-3 w-full mt-1"
                >
                    <option value="">Tous les statuts</option>
                    <option value="{{ AnimalStatus::AVAILABLE->value }}">
                        Disponible
                    </option>

                    <option value="{{ AnimalStatus::PENDING->value }}">
                        En attente
                    </option>

                    <option value="{{ AnimalStatus::INCARE->value }}">
                        En soins
                    </option>
                </select>
            </div>
            <div class="col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
                <label class="pl-1" for="age">{{ __('animals.age') }}</label>
                <select wire:model.live="age" id="age" class="bg-element rounded-lg p-3 w-full mt-1">
                    <option value="">{{ __('animals.select_age') }}</option>
                    @for($i=1; $i<=5; $i++)
                        <option value="{{ $i }}">{{ $i }} {{ __('animals.months') }}</option>
                    @endfor
                </select>
            </div>
            <div class="relative col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
                <label for="sort" id="sort">Trier</label>
                <select
                    class="flex items-center justify-between w-full p-3 mt-1 bg-element rounded-lg">
                    <option value="">Trier</option>
                    <option wire:click="sortBy('name','asc')" value="Nom A → Z">Nom A → Z</option>
                    <option wire:click="sortBy('name','desc')" value="Nom Z → A">Nom Z → A</option>
                    <option wire:click="sortBy('age','asc')" value="Âge croissant">Âge croissant</option>
                    <option wire:click="sortBy('age','desc')" value="Âge décroissant">Âge décroissant</option>
                </select>
            </div>

        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-6 lg:ml-40 lg:mr-40 lg:mb-40 pb-3">
            @foreach($this->animals as $animal)
                <x-cards.animal-card
                    :name="$animal->name"
                    :sex="$animal->gender ? __('animals.male') : __('animals.female')"
                    :age="$animal->age?->format('d/m/Y')"
                    :status="$animal->status_label"
                    :id="$animal->id"
                    :animal="$animal"
                    :avatar="$animal->avatar_path"
                    :status-color="$animal->statusColor"
                    :breed="$animal->breed"
                />
            @endforeach
        </div>
        <div class="mt-6 mb-12 flex justify-center">
            <div class="bg-element rounded-xl px-4 py-3 shadow-sm">
                {{ $this->animals->links('vendor.pagination.livewire-tailwind') }}
            </div>
        </div>
    </div>
</div>
