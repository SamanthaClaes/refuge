<?php

namespace App\Http\Livewire\Pages\AnimalFilters;


use App\Models\Animal;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;
    public $specie = '';
    public $breed = '';
    public $age = '';
    public $pelage = '';
    public string $sortColumn = 'name';
    public string $sortDirection = 'asc';
    protected string $paginationTheme = 'tailwind';


    #[Computed]
    public function animals()
    {
        $query = Animal::query();

        if ($this->specie) {
            $query->where('specie', $this->specie);
        }

        if ($this->age) {
            $query->where('age', $this->age);
        }

        if ($this->breed) {
            $query->where('breed', $this->breed);
        }

        if ($this->pelage) {
            $query->where('pelage', $this->pelage);
        }

        if ($this->sortColumn === 'age') {
            $query->orderBy('age', $this->sortDirection);
        } else {
            $query->orderBy($this->sortColumn, $this->sortDirection);
        }

        return $query->paginate(9);
    }

    public function render()
    {
        $availableBreeds = Animal::when(
            $this->specie,
            fn ($q) => $q->where('specie', $this->specie)
        )
            ->distinct()
            ->pluck('breed');

        return view('livewire.pages.⚡animal-filters.animal-filters', [
            'availableBreeds' => $availableBreeds,
        ]);
    }


    public function sortBy( string $column, string $direction): void
    {
        $this->sortColumn = $column;
        $this->sortDirection = $direction;
    }
};
