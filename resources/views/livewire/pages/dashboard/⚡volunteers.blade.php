<?php

use App\Mail\VolunteerWelcomeMail;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Volontaires | Dashboard ')]
class extends Component {
    public string $name = '';
    public string $email = '';
    public ?int $userId = null;
    public string $phone = '';
    public string $password = '';

    public string $role = 'volunteer';

    public function mount()
    {
        $this->authorize('view', User::class);
    }

    public function getUsersProperty()
    {
        return User::where('role', 'volunteer')->get();
    }


    public function store(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'password' => bcrypt(Str::random(32)),
        ]);

        Mail::to($user->email)
            ->queue(new VolunteerWelcomeMail($user));

        $this->showCreateVolunteerModal = false;

        $this->reset([
            'name',
            'email',
            'phone',
            'role',
        ]);
        $this->dispatch('volunteer-created');

        session()->flash('message', 'Bénévole créé et email envoyé.');
    }


    public function openEditVolunteerModal($userId): void
    {
        $user = User::findOrFail($userId);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->dispatch('open-edit-volunteer-modal');
    }


    public function editVolunteer(): void
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'phone' => 'required',
        ]);

        $user = User::findOrFail($this->userId);
        $user->update($validated);
        $this->reset(['name', 'email', 'phone']);
        $this->dispatch('volunteer-edited');

    }

    public function deleteVolunteer(int $userId): void
    {
        $user = User::findOrFail($userId);
        $user->delete();
    }

    public function openCreateVolunteerModal(): void
    {
        $this->reset([
            'name',
            'email',
            'phone',
            'role',
        ]);

        $this->dispatch('open-create-volunteer-modal');
    }
};
?>

<div>
    <header>
        <x-header.side-bar/>
    </header>
    <main>
        <div class="pl-72 pr-12 grid grid-cols-12 gap-4">
            <section class="row-start-2 col-span-12">
                <h1 class="sr-only">Liste des bénévoles</h1>
                <div class="flex justify-between items-center">
                    <h2 class="pt-8 font-semibold text-text text-xl pb-4">Listes des bénévoles</h2>
                    <x-cta.addVolunteer title="+ Ajouter un bénévole"/>
                </div>
                <div class="p-4 bg-element rounded-2xl">
                    <div class="rounded-lg">
                        <table class="w-full">
                            <thead class="border-b">
                            <tr class="bg-background">
                                <th class="border-r">Nom</th>
                                <th class="border-r">Email</th>
                                <th class="border-r">Téléphone</th>
                                <th class="rounded-l-lg">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse( $this->users as  $key => $user)
                                <tr>
                                    <x-table.table-data>
                                        {{ $user->name }}
                                    </x-table.table-data>
                                    <x-table.table-data>
                                        {{  $user->email }}
                                    </x-table.table-data>
                                    <x-table.table-data>
                                        {{  $user->phone }}
                                    </x-table.table-data>
                                    <x-table.table-data is-last="true">
                                        <div x-data="{ open: false }" class="relative flex justify-center">

                                            <button
                                                type="button"
                                                @click="open = !open"
                                                class="px-3 py-1 rounded bg-element hover:bg-hover cursor-pointer"
                                            >
                                                ⋮
                                            </button>

                                            <div
                                                x-show="open"
                                                @click.outside="open = false"
                                                x-cloak
                                                class="absolute right-0 mt-2 w-40 bg-white border rounded-lg shadow-lg z-50"
                                            >
                                                <button
                                                    type="button"
                                                    wire:click="openEditModal({{ $user->id }})"
                                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                                                >
                                                    Modifier
                                                </button>
                                                    <button
                                                        type="button"
                                                        wire:click="deleteAnimal({{ $user->id }})"
                                                        wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $user->name }} ?"
                                                        class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100"
                                                    >
                                                        Supprimer
                                                    </button>
                                            </div>

                                        </div>
                                    </x-table.table-data>
                                </tr>

                            </tbody>
                            @empty
                                <p> Pas de bénévoles</p>
                            @endforelse
                        </table>
                    </div>
                </div>
                <div class="flex justify-between items-center mt-8">
                    <h2 class="pt-8 font-semibold text-text text-xl pb-4">Planning des bénévoles</h2>
                    <x-cta.addVolunteer title="+ Ajouter un planning"/>
                </div>
                <section class="p-4 bg-element rounded-2xl">
                    <div class="rounded-lg overflow-clip border">
                        <table class="w-full">
                            <thead class="">
                            <tr class="bg-background">
                                <th class="p-3 border-r">Nom</th>
                                <th class="p-3 border-r">Lundi</th>
                                <th class="p-3 border-r">Mardi</th>
                                <th class="p-3 border-r"> Mercredi</th>
                                <th class="p-3 border-r">Jeudi</th>
                                <th class="p-3 rounded-l-lg border-r">Vendredi</th>
                                <th class="p-3 rounded-l-lg">Samedi</th>
                                <th class="p-3 rounded-l-lg">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse( $this->users as  $key => $user)
                                <tr>
                                    <x-table.table-data>
                                        {{ $user->name }}
                                    </x-table.table-data>
                                    <x-table.table-data>
                                        09:00 – 10:00
                                    </x-table.table-data>
                                    <x-table.table-data>
                                        13:30 – 14:30
                                    </x-table.table-data>
                                    <x-table.table-data>
                                        16:00 – 17:00
                                    </x-table.table-data>
                                    <x-table.table-data>
                                        12:30 – 13:30
                                    </x-table.table-data>
                                    <x-table.table-data>
                                        09:00 – 10:00
                                    </x-table.table-data>
                                    <x-table.table-data>
                                        13:30 – 14:30
                                    </x-table.table-data>
                                    <x-table.table-data is-last="true">
                                        <div x-data="{ open: false }" class="relative flex justify-center">

                                            <button
                                                type="button"
                                                @click="open = !open"
                                                class="px-3 py-1 rounded bg-element hover:bg-hover cursor-pointer"
                                            >
                                                ⋮
                                            </button>

                                            <div
                                                x-show="open"
                                                @click.outside="open = false"
                                                x-cloak
                                                class="absolute right-0 mt-2 w-40 bg-white border rounded-lg shadow-lg z-50"
                                            >
                                                <button
                                                    type="button"
                                                    wire:click="openEditModal({{ $user->id }})"
                                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                                                >
                                                    Modifier
                                                </button>
                                            </div>
                                        </div>
                                    </x-table.table-data>
                                </tr>

                            </tbody>
                            @empty
                                <p> Pas de bénévoles</p>
                            @endforelse
                        </table>
                    </div>
                </section>
            </section>
        </div>
        <div>
            <x-modals.createVolunteer_modal/>
        </div>
        <div>
        <x-modals.editVolunteer_modal/>
        </div>
    </main>
</div>
