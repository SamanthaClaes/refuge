<?php
namespace livewire\pages\⚡dashboard;
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

new class extends Component {
    use WithFileUploads;
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
    public function animals(): Collection
    {
        return Animal::query()
            ->where('file', true)
            ->where('status', 'disponible')
            ->whereDoesntHave('adoptions', fn($q) => $q->ongoing())
            ->when($this->searchBar !== '', function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->searchBar . '%')
                        ->orWhere('breed', 'like', '%' . $this->searchBar . '%')
                        ->orWhere('specie', 'like', '%' . $this->searchBar . '%');
                });
            })
            ->get();

    }
    public function render()
    {
        return view('livewire.pages.⚡dashboard.dashboard')
            ->title('Dashboard');
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

        if ($this->avatar) {
            $imageType = 'jpg';
            $originalPath = 'avatars/original';
            $fileName = 'avatar_img_' . uniqid() . '.' . $imageType;
            $avatarPath = $this->avatar->storeAs($originalPath, $fileName, 'public');
            ProcessAnimalAvatar::dispatch($fileName, $avatarPath);
        }
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
            'file' => auth()->user()->isAdmin(),
            'created_by' => auth()->id(),
        ]);

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

    #[Computed]
    public function animalsCount(): int
    {
        return Animal::count();
    }

    #[Computed]
    public function volunteersCount(): int
    {
        return User::count();
    }

    #[Computed]
    public function availableAnimalsCount(): int
    {
        return Animal::where('status', 'available')->count();
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
            ->where('status', 'adopted')
            ->groupBy('month')
            ->pluck('total', 'month');

        $arrived = Animal::selectRaw("$monthExpression as month, COUNT(*) as total")
            ->groupBy('month')
            ->pluck('total', 'month');

        $months = collect(range(1, 12));

        return [
            'labels' => $months->map(fn ($m) =>
            now()->month($m)->translatedFormat('M')
            )->values(),

            'adopted' => $months->map(fn ($m) =>
            intval($adopted[str_pad($m, 2, '0', STR_PAD_LEFT)] ?? 0)
            )->values(),

            'arrived' => $months->map(fn ($m) =>
            intval($arrived[str_pad($m, 2, '0', STR_PAD_LEFT)] ?? 0)
            )->values(),

            'remaining' => $months->map(fn ($m) =>
            intval(
                ($arrived[str_pad($m, 2, '0', STR_PAD_LEFT)] ?? 0) -
                ($adopted[str_pad($m, 2, '0', STR_PAD_LEFT)] ?? 0)
            )
            )->values(),
        ];
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

    #[Computed]
    public function pendingAnimals()
    {
        return Animal::where('file', false)
            ->whereHas('creator', function ($query) {
                $query->where('role', 'volunteer');
            })
            ->get();
    }

    public function validateAnimal(int $animalId): void
    {
        $animal = Animal::findOrFail($animalId);

        if (!auth()->user()->isAdmin()) {
            session()->flash('error', 'Vous n’avez pas la permission de valider cette fiche.');
            return;
        }
        $animal->update([
            'file' => true,
        ]);

        session()->flash('message', 'Fiche validée avec succès !');
    }

    public function deleteAnimal(int $animalId): void
    {
        $animal = Animal::findOrFail($animalId);
        $animal->delete();
    }
};

