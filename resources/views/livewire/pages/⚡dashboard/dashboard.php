<?php

namespace livewire\pages\⚡dashboard;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelIdea\Helper\App\Models\_IH_Animal_C;
use Livewire\Attributes\Title;
use App\Jobs\ProcessAnimalAvatar;
use App\Mail\AnimalCreatedMail;
use App\Models\Adoption;
use App\Models\Animal;
use App\Models\ContactMessage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

new class extends Component {
    use WithFileUploads;
    use WithPagination;

    protected string $paginationTheme = 'tailwind';
    public int $unreadCount = 0;
    public int $animalId;
    public bool $showCreateAnimalModal = false;

    public string $description = '';
    public ?string $adoptionStartDate = null;
    public array $avatar_path = [];
    public ?string $adoptionClosedAt = null;
    public bool $showEditAnimalModal = false;
    public string $name = '';
    public string $breed = '';
    public string $specie = '';
    public string $age = '';
    public string $status = 'disponible';
    public bool $vaccine = false;
    public bool $gender = true;
    public $avatar;
    public string $searchBar = '';



    #[Computed]
    public function animals()
    {
        return Animal::query()
            ->when($this->searchBar !== '', function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->searchBar . '%')
                        ->orWhere('breed', 'like', '%' . $this->searchBar . '%')
                        ->orWhere('specie', 'like', '%' . $this->searchBar . '%');
                });
            })
            ->latest()
            ->paginate(3);
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
        }

        $this->showEditAnimalModal = true;
    }

    public function editAnimal(): void
    {
        $this->editAnimalModal();
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

    public function editAnimalModal(): void
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

        $this->showEditAnimalModal = false;

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


    public function updatedSearchBar(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.pages.⚡dashboard.dashboard')
            ->title('Dashboard');
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

    public function closeEditModal(): void
    {
        $this->showEditAnimalModal = false;
    }

    #[Computed]
    public function animalsCount(): int
    {
        return Animal::count();
    }

    #[Computed]
    public function volunteersCount(): int
    {
        return $this->users()->count();
    }

    #[Computed]
    public function availableAnimalsCount(): int
    {
        return Animal::where('status', 'available')->count();
    }

    #[Computed]
    public function users()
    {
        return User::where('role', 'volunteer')->get();
    }

    public function mount(): void
    {
        $this->updateUnreadCount();
    }

    #[On('messageCreated')]
    public function updateUnreadCount(): void
    {
        $this->unreadCount = ContactMessage::where('read', false)->count();
    }
    public function createAnimal(): void
    {
        $this->toggleModal('createAnimal', 'open');
    }

    #[Computed]
    public function animalsChartData(): array
    {
        $driver = DB::getDriverName();

        $monthExpression = match ($driver) {
            'sqlite' => "strftime('%m', created_at)",
            default  => "MONTH(created_at)",
        };

        $adopted = Animal::selectRaw("$monthExpression as month, COUNT(*) as total")
            ->where('status', 'adopté(e)')
            ->groupBy('month')
            ->pluck('total', 'month');

        $arrived = Animal::selectRaw("$monthExpression as month, COUNT(*) as total")
            ->groupBy('month')
            ->pluck('total', 'month');

        $months = collect(range(1, 12));

        return [
            'labels' => $months->map(fn ($m) =>
            now()->month($m)->translatedFormat('MMM')
            )->values(),

            'adopted' => $months->map(fn ($m) =>
            (int) ($adopted[str_pad($m, 2, '0', STR_PAD_LEFT)] ?? 0)
            )->values(),

            'arrived' => $months->map(fn ($m) =>
            (int) ($arrived[str_pad($m, 2, '0', STR_PAD_LEFT)] ?? 0)
            )->values(),

            'remaining' => $months->map(fn ($m) =>
            (int) (
                ($arrived[str_pad($m, 2, '0', STR_PAD_LEFT)] ?? 0)
                - ($adopted[str_pad($m, 2, '0', STR_PAD_LEFT)] ?? 0)
            )
            )->values(),
        ];
    }
    public function download()
    {
        $chartData = $this->animalsChartData();
        $data = [];

        foreach ($chartData['labels'] as $i => $month) {
            $data[] = [
                'month' => $month,
                'arrived' => $chartData['arrived'][$i] ?? 0,
                'adopted' => $chartData['adopted'][$i] ?? 0,
                'remaining' => $chartData['remaining'][$i] ?? 0,
            ];
        }

        return Pdf::loadView('PDF.pdf', ['data' => $data])
            ->setPaper('a4')
            ->download('rapport-animaux-' . now()->format('Y-m-d') . '.pdf');
    }
    public function deleteAnimal(int $animalId): void
    {
        $animal = Animal::findOrFail($animalId);
        $animal->delete();
    }
    #[Computed]
    public function pendingAnimals()
    {
        return Animal::where('file', false)
            ->whereHas('creator', function ($query) {
                $query->where('role', 'volunteer');
            })
            ->paginate(3);
    }



};
