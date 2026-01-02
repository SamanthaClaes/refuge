<?php

namespace livewire\pages\⚡dashboard;

use App\Jobs\ProcessAnimalAvatar;
use App\Mail\AnimalCreatedMail;
use App\Models\Animal;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;


new class extends Component
{
    use WithFileUploads;
    public int $unreadCount = 0;
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
            ->where('file', true)
            ->where('status', 'disponible')
            ->whereDoesntHave('adoptions', fn ($q) => $q->ongoing())
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

       $animal =  Animal::create([
            'name' => $this->name,
            'breed' => $this->breed,
            'specie' => $this->species,
            'age' => $this->age,
            'status' => $this->status,
            'vaccine' => $this->vaccine,
            'gender' => $this->gender,
            'avatar_path' => $avatarPath,
            'file' => false,
            'created_by' => auth()->id(),
        ]);


        session()->flash('message', 'Animal ajouté avec succès !');
        Mail::to(auth()->user()->email)
            ->queue(new AnimalCreatedMail($animal));

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
    #[Computed]
    public function animalsChartData(): array
    {
        $adopted = Animal::selectRaw("MONTH(created_at) as month, COUNT(*) as total")
            ->where('status', 'adopted')
            ->groupBy('month')
            ->pluck('total', 'month');

        $arrived = Animal::selectRaw("MONTH(created_at) as month, COUNT(*) as total")
            ->groupBy('month')
            ->pluck('total', 'month');

        $months = collect(range(1, 12));

        return [
            'labels' => $months->map(fn ($m) =>
            now()->month($m)->translatedFormat('M')
            )->values(),

            'adopted' => $months->map(fn ($m) =>
            intval($adopted[$m] ?? 0)
            )->values(),

            'arrived' => $months->map(fn ($m) =>
            intval($arrived[$m] ?? 0)
            )->values(),

            'remaining' => $months->map(fn ($m) =>
            intval(
                ($arrived[$m] ?? 0) -
                ($adopted[$m] ?? 0)
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
        return Animal::where('file', false)->get();
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

