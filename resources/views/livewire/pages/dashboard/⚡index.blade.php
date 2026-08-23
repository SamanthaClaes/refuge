<?php

namespace livewire\pages\⚡dashboard;

use App\Enums\AnimalStatus;
use App\Models\AdoptionRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelIdea\Helper\App\Models\_IH_Animal_C;
use Livewire\Attributes\Layout;
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
use App\Models\AnimalTypes;
use App\Models\Breed;

new #[Layout('layouts.admin', ['title' => ' Admin | Dashboard '])]
class extends Component {
    use WithFileUploads;
    use WithPagination;

    protected string $paginationTheme = 'tailwind';
    public int $unreadCount = 0;
    public int $adoptionRequest = 0;
    public ?int $animalId = null;
    public ?string $currentAvatar = null;
    public string $description = '';
    public ?string $adoptionStartDate = null;
    public array $avatar_path = [];
    public ?string $adoptionClosedAt = null;
    public string $name = '';
    public ?int $breed_id = null;
    public ?int $animal_type_id = null;
    public string $age = '';
    public string $status = 'disponible';
    public bool $vaccine = false;
    public bool $gender = true;
    public $avatar;
    public string $searchBar = '';


    public function animal(): Animal
    {
        return Animal::findOrFail($this->animalId);
    }

    #[Computed]
    public function animals(): LengthAwarePaginator
    {
        return Animal::query()
            ->where('status', '!=', AnimalStatus::ADOPTED)
            ->where('file', true)
            ->when($this->searchBar !== '', function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->searchBar . '%')
                        ->orWhereHas('breed', function ($q) {
                            $q->where('name', 'like', '%' . $this->searchBar . '%');
                        })
                        ->orWhereHas('animalType', function ($q) {
                            $q->where('name', 'like', '%' . $this->searchBar . '%');
                        });
                });
            })
            ->latest()
            ->paginate(5, pageName: 'pendingAnimalsPage');
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'breed_id' => 'required|exists:breeds,id',
            'animal_type_id' => 'required|exists:animal_types,id',
            'age' => 'nullable|date|before_or_equal:today',
            'status' => 'required|string',
            'vaccine' => 'required|boolean',
            'gender' => 'required|boolean',
            'description' => 'nullable|string',
            'avatar_path.*' => 'image|max:2048',
            'adoptionStartDate' => 'nullable|date_format:Y-m-d',
            'adoptionClosedAt' => 'nullable|date_format:Y-m-d|after_or_equal:adoptionStartDate',
        ];
    }

    protected function fillAnimal(Animal $animal): void
    {
        $this->fill([
            'animalId' => $animal->id,
            'name' => $animal->name,
            'breed_id' => $animal->breed_id,
            'animal_type_id' => $animal->animal_type_id,
            'gender' => $animal->gender,
            'age' => optional($animal->age)->format('Y-m-d'),
            'status' => $animal->status,
            'vaccine' => $animal->vaccine,
            'description' => $animal->description,
        ]);
    }


    public function getAnimalTypesProperty()
    {
        return AnimalTypes::orderBy('name')->get();
    }

    public function getBreedsProperty()
    {
        return Breed::where('animal_type_id', $this->animal_type_id)
            ->orderBy('name')
            ->get();
    }

    public function openCreateModal(): void
    {
        $this->resetForm();
        $this->dispatch('open-create-modal');
    }

    public function openEditModal(int $animalId): void
    {
        $animal = Animal::findOrFail($animalId);

        $this->fillAnimal($animal);

        $this->currentAvatar = $animal->getAvatarUrl();

        $adoption = Adoption::where('animal_id', $animal->id)->first();

        if ($adoption) {
            $this->adoptionStartDate = $adoption->started_at?->format('Y-m-d');
            $this->adoptionClosedAt = $adoption->closed_at?->format('Y-m-d');
        }

        $this->dispatch('open-edit-modal');
    }

    public function editAnimal(): void
    {
        $this->editAnimalModal();
    }

    public function storeAnimal(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'breed_id' => 'required|exists:breeds,id',
            'animal_type_id' => 'required|exists:animal_types,id',
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
            $status = AnimalStatus::PENDING;
        } elseif ($this->adoptionClosedAt) {
            $status = AnimalStatus::ADOPTED;
        }
        $animal = Animal::create([
            'name' => $this->name,
            'breed_id' => $this->breed_id,
            'animal_type_id' => $this->animal_type_id,
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
        $this->resetForm();

    }

    public function validateAnimal(int $animalId): void
    {
        $animal = Animal::findOrFail($animalId);

        $animal->update([
            'file' => true,
        ]);

        session()->flash('message', 'La fiche a été validée avec succès.');
    }

    public function editAnimalModal(): void
    {
        $validated = $this->validate();

        $animal = $this->animal();

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

        $this->resetForm();
        $this->dispatch('animal-edited');

        session()->flash('message', 'Animal modifié avec succès!');
    }

    public function updatedSearchBar(): void
    {
        $this->resetPage();
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
        return Animal::where('status', AnimalStatus::AVAILABLE)->count();
    }

    #[Computed]
    public function users(): LengthAwarePaginator
    {
        return User::where('role', 'volunteer')->paginate(5, pageName: 'Volunteer');
    }

    public function mount(): void
    {
        $this->updateUnreadCount();
        $this->updateAdoptionRequestCount();
    }

    #[On('messageCreated')]
    public function updateUnreadCount(): void
    {
        $this->unreadCount = ContactMessage::where('read', false)->count();
    }

    public function updateAdoptionRequestCount(): void
    {
        $this->adoptionRequest = AdoptionRequest::where('isRead', false)->count();
    }


    public function resetForm(): void
    {
        $this->fill([
            'animalId' => null,
            'name' => '',
            'breed_id' => null,
            'animal_type_id' => null,
            'description' => '',
            'age' => '',
            'status' => 'disponible',
            'vaccine' => false,
            'gender' => true,
            'avatar' => null,
            'avatar_path' => [],
            'adoptionStartDate' => null,
            'adoptionClosedAt' => null,
            'currentAvatar' => null,
        ]);
    }


    #[Computed]
    public function animalsChartData(): array
    {
        $driver = DB::getDriverName();

        $monthExpression = match ($driver) {
            'sqlite' => "strftime('%m', created_at)",
            default => "MONTH(created_at)",
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
            'labels' => $months->map(fn($m) => now()->month($m)->translatedFormat('MMM')
            )->values(),

            'adopted' => $months->map(fn($m) => (int)($adopted[str_pad($m, 2, '0', STR_PAD_LEFT)] ?? 0)
            )->values(),

            'arrived' => $months->map(fn($m) => (int)($arrived[str_pad($m, 2, '0', STR_PAD_LEFT)] ?? 0)
            )->values(),

            'remaining' => $months->map(fn($m) => (int)(
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
    public function pendingAnimals(): LengthAwarePaginator
    {
        return Animal::where('file', false)
            ->whereHas('creator', function ($query) {
                $query->where('role', 'volunteer');
            })
            ->paginate(3, pageName: 'pendingFile');
    }


};
?>
<div>
    <div>
        <x-searchBar/>
        <x-cards.allDashboardCard/>
        <section class="row-start-2 col-span-12 mt-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                <h2 class="font-semibold text-text text-xl pb-4 md:pb-0">Liste de tous les animaux</h2>
                <x-cta.add title="+ Ajouter un animal"/>
            </div>
            <x-table.animalTables.allAnimals_table
                :animals="$this->animals"
            />
            @if( auth()->user()->isAdmin())
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mt-8 mb-4">
                    <h2 class="font-semibold text-text text-xl pb-4 md:pb-0">Fiches en attente de validation</h2>
                </div>

                <x-table.animalTables.filesTables/>


                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mt-8 mb-4">
                    <h2 class="font-semibold text-text text-xl pb-4 md:pb-0">Liste de nos bénévoles</h2>
                </div>

                <div class="p-4 bg-element rounded-2xl overflow-x-auto">
                    <table class="min-w-full border">
                        <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="border-r px-2 py-2">Nom</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($this->users as $user)
                            <tr>
                                <x-table.table-data>{{ $user->name }}</x-table.table-data>
                            </tr>
                        @empty
                            <tr>
                                <td class="bg-white p-3 text-center">Pas de bénévoles trouvés</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                </div>
                <div class="mt-6 mb-12 flex justify-center">
                    <div class="bg-element rounded-xl px-4 py-3 shadow-sm">
                        {{ $this->users->links('vendor.pagination.livewire-tailwind') }}
                    </div>
                </div>


                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 mt-8"
                     wire:ignore>
                    <h2 class="font-semibold text-text text-xl pb-4">Statistiques du mois</h2>
                    <a
                        href="{{ route('admin.dashboard.pdf') }}"
                        target="_blank"
                        class="bg-cta p-2 h-10 rounded-xl text-white hover:bg-hover cursor-pointer px-4 inline-flex items-center"
                    >
                        Exporter en PDF
                    </a>
                </div>

                <div wire:ignore>
                    <canvas id="animalsChart" data-chart='@json($this->animalsChartData)'>
                    </canvas>
                </div>
        </section>
        @endif
        <div>
            <x-modals.createAnimal_modal :avatar="$avatar"/>
        </div>
        <div>
            <x-modals.editAnimal_modal :avatar="$avatar" :currentAvatar="$currentAvatar"/>
        </div>
    </div>

</div>
