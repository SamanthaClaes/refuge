@php use App\Models\Adoption; @endphp
<main class="bg-background">
    <x-header.search-bar/>
    <div class="pl-72 pr-12 grid grid-cols-12 gap-4">
        <section class="row-start-2 col-span-12">
            <h1 class="sr-only">Liste de tous les animaux</h1>
            <div class="flex justify-between items-center">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste de tous les animaux</h2>
                <x-cta.add title="+ Ajouter un animal"/>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <div class="rounded-lg overflow-clip border-1">
                    <table class="w-full">
                        <thead>
                        <tr class="bg-background">
                            <th class="p-3 border-r-1">Nom</th>
                            <th class="p-3 border-r-1">Espèce</th>
                            <th class="p-3 border-r-1">Genre</th>
                            <th class="p-3 border-r-1"> Statut</th>
                            <th class="p-3 border-r-1">Fiche</th>
                            <th class="p-3 rounded-l-lg">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($this->animals as $key => $animal)
                            <tr>
                                <x-table.table-data>
                                    {{ $animal->name }}
                                </x-table.table-data>
                                <x-table.table-data>
                                    {{ $animal->breed }}
                                </x-table.table-data>
                                <x-table.table-data>
                                    {{ $animal->gender ? 'Mâle'  : 'Femelle'}}
                                </x-table.table-data>
                                <x-table.table-data>
                                    {{ $animal->status }}
                                </x-table.table-data>
                                <x-table.table-data>
                                    {{ $animal->file ? 'validée' : 'à valider' }}
                                </x-table.table-data>
                                <x-table.table-data is-last="true">
                                    <x-svg.pen :animal-id="$animal->id" :key="$key"/>
                                    <x-svg.delete :animal-id="$animal->id"
                                                  wire:click="deleteAnimal({{ $animal->id }})"
                                                  wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $animal->name }} ?"/>
                                </x-table.table-data>
                            </tr>
                        </tbody>
                        @empty
                            <tr class="rounded">
                                <td class="bg-white p-3" colspan="6">
                                    Pas d’animaux trouvés
                                </td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
            <div class="mt-6 mb-12 flex justify-center">
                <div class="bg-element rounded-xl px-4 py-3 shadow-sm">
                    {{ $this->animals->links('vendor.pagination.livewire-tailwind') }}
                </div>
            </div>
            <div class="flex justify-between items-center mt-8">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste des animaux en cours d’adoption</h2>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <div class="rounded-lg overflow-clip border-1">
                    <table class="w-full">
                        <thead class="border-b-1">
                        <tr class="bg-background">
                            <th class="p-3 border-r-1">Nom</th>
                            <th class="p-3 border-r-1">Espèce</th>
                            <th class="p-3 border-r-1">Genre</th>
                            <th class="p-3 border-r-1"> Date d’adoption</th>
                            <th class="p-3 border-r-1">Fiche</th>
                            <th class="p-3 rounded-l-lg">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($this->ongoingAdoptions as $adoption)
                            <tr class="rounded">
                                <x-table.table-data>
                                    {{ $adoption->animal->name }}
                                </x-table.table-data>
                                <x-table.table-data>
                                    {{ $adoption->animal->breed }}
                                </x-table.table-data>
                                <x-table.table-data>
                                    {{ $adoption->animal->gender ? 'Mâle'  : 'Femelle'}}
                                </x-table.table-data>
                                <x-table.table-data>
                                    {{ $adoption->closed_as_string }}
                                </x-table.table-data>
                                <x-table.table-data>
                                    {{ $adoption->animal->file ? 'validée' : 'à valider' }}
                                </x-table.table-data>
                                <x-table.table-data>
                                    <x-svg.pen :animal-id="$adoption->animal->id" :key="$key"/>
                                    <x-svg.delete :animal-id="$animal->id"
                                                  wire:click="deleteAnimal({{ $animal->id }})"
                                                  wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $animal->name }} ?"/>
                                </x-table.table-data>

                            </tr>
                        @empty
                            <tr class="rounded">
                                <td class="bg-white p-3" colspan="6">
                                    Pas d’animaux trouvés
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <section>
                <div class="flex justify-between items-center mt-8">
                    <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste des animaux en soins</h2>
                </div>
            </section>
            <div class="p-4 bg-element rounded-2xl">
                <table class="border-1 w-full">
                    <thead>
                    <tr class="bg-background">
                        <th class="p-3 border-r-1">Nom</th>
                        <th class="p-3 border-r-1">Espèce</th>
                        <th class="p-3 border-r-1">Genre</th>
                        <th class="p-3 border-r-1"> Date d’adoption</th>
                        <th class="p-3 border-r-1">Fiche</th>
                        <th class="p-3 rounded-l-lg">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($this->oncareAnimals as $animal)
                        <tr class="rounded">
                            <x-table.table-data>
                                {{ $animal->name }}
                            </x-table.table-data>
                            <x-table.table-data>
                                {{ $animal->breed }}
                            </x-table.table-data>
                            <x-table.table-data>
                                {{ $animal->gender ? 'Mâle'  : 'Femelle'}}
                            </x-table.table-data>
                            <x-table.table-data>
                                {{ $animal->status }}
                            </x-table.table-data>
                            <x-table.table-data>
                                {{ $animal->file ? 'validée' : 'à valider' }}
                            </x-table.table-data>
                            <x-table.table-data>
                                <x-svg.pen :animal-id="$animal->id" :key="$key"/>
                                <x-svg.delete :animal-id="$animal->id"
                                              wire:click="deleteAnimal({{ $animal->id }})"
                                              wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $animal->name }} ?"/>
                            </x-table.table-data>

                        </tr>
                    @empty
                        <tr class="rounded">
                            <td class="bg-white p-3" colspan="6">
                                Pas d’animaux trouvés
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-8">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste des animaux adoptés</h2>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <table class="border-1 w-full">
                    <thead>
                    <tr class="bg-background">
                        <th class="p-3 border-r-1">Nom</th>
                        <th class="p-3 border-r-1">Espèce</th>
                        <th class="p-3 border-r-1">Genre</th>
                        <th class="p-3 border-r-1"> Date d’adoption</th>
                        <th class="p-3 border-r-1">Fiche</th>
                        <th class="p-3 rounded-l-lg">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($this->closedAdoptions as $adoption)
                        <tr class="rounded">
                            <x-table.table-data>
                                {{ $adoption->animal->name }}
                            </x-table.table-data>
                            <x-table.table-data>
                                {{ $adoption->animal->breed }}
                            </x-table.table-data>
                            <x-table.table-data>
                                {{ $adoption->animal->gender ? 'Mâle'  : 'Femelle'}}
                            </x-table.table-data>
                            <x-table.table-data>
                                {{ $adoption->closed_as_string }}
                            </x-table.table-data>
                            <x-table.table-data>
                                {{ $adoption->animal->file ? 'validée' : 'à valider' }}
                            </x-table.table-data>
                            <x-table.table-data>
                                <x-svg.pen :animal-id="$adoption->animal->id" :key="$key"/>
                                <x-svg.delete :animal-id="$animal->id"
                                              wire:click="deleteAnimal({{ $animal->id }})"
                                              wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $animal->name }} ?"/>
                            </x-table.table-data>

                        </tr>
                    @empty
                        <tr class="rounded">
                            <td class="bg-white p-3" colspan="6">
                                Pas d’animaux trouvés
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <div class="{{ $showCreateAnimalModal ? 'block' : 'hidden' }}">
        <x-partials.modal>
            <div class="flex justify-around">
                <x-slot:title>
                    Ajouter une fiche animale
                    <button type="button" wire:click="toggleModal('createAnimal', 'close')" class="p-2">
                        <img src="{{ asset('svg/close.svg') }}" alt="croix" height="30" width="30">
                    </button>
                </x-slot:title>
            </div>
            <x-slot:body>
                <form wire:submit.prevent="createAnimalinDB" class="space-y-2" enctype="multipart/form-data">
                    <div>
                        <label for="avatar">Choisir l’avatar</label>
                        <input type="file" wire:key="avatar-input" wire:model="avatar"
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text" id="avatar" name="avatar">
                    </div>
                    <div>
                        <label for="avatar_path">Choisir les avatars</label>
                        <input type="file" multiple wire:key="avatar_path-input" wire:model="avatar_path"
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text" id="avatar_path"
                               name="avatar_path[]">
                    </div>
                    <div>
                        <label for="name" id="name">Nom</label>
                        <input wire:model="name" class="mt-1 w-full bg-background rounded-lg pl-2 font-text" type="text"
                               id="name"
                               name="name">
                    </div>
                    <div class="flex justify-between gap-4 ">
                        <div class="flex flex-col">
                            <label for="specie" id="specie">Espèces</label>
                            <select wire:model="specie" id="specie" name="specie"
                                    class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                                <option value="">Choisir une espèce</option>
                                <option value="dog">Chien</option>
                                <option value="cat">Chat</option>
                                <option value="birds">Oiseau</option>
                                <option value="bunny">Lapin</option>
                                <option value="rat">Rat</option>
                                <option value="ferret">Furet</option>
                            </select>
                        </div>
                        <div class="flex flex-col">
                            <label for="breed" id="breed">Race</label>
                            <input wire:model="breed" type="text" id="breed" name="breed"
                                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                        </div>
                        <div class="flex flex-col">
                            <label for="gender" id="gender">Genre</label>
                            <select class="mt-1 w-full bg-background rounded-lg pl-2 font-text" wire:model="gender">
                                <option value="1">Mâle</option>
                                <option value="0">Femelle</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="age" id="age">Date de naissance</label>
                        <input wire:model="age" type="date" id="age" name="age"
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                    </div>
                    <div>
                        <label for="status">Statut</label>
                        <select wire:model="status" class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                            <option value="">Choisir un statut</option>
                            <option value="disponible">Disponible</option>
                            <option value="en attente">En attente</option>
                            <option value="en soins">En soins</option>
                            <option value="adopté(e)">Adopté(e)</option>
                        </select>
                        <div>
                            <label for="adoption_start">Date début adoption (optionnelle)</label>
                            <input type="date" wire:model="adoptionStartDate" id="adoption_start"
                                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                            <label for="closed_at">Date clôture adoption</label>
                            <input type="date" wire:model="adoptionClosedAt" id="closed_at"
                                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                        </div>
                    </div>
                    <div>
                        <label for="status" id="status">Vaccin</label>
                        <select class="mt-1 w-full bg-background rounded-lg pl-2 font-text" wire:model="vaccine">
                            <option value="">Choissisez une option</option>
                            <option value="1">Vacciné</option>
                            <option value="0">Pas de vaccin</option>
                        </select>
                    </div>
                    <div>
                        <label for="description" id="description">Description</label>
                        <textarea
                            id="description"
                            class="mt-1 w-full bg-background rounded-lg pl-2 font-text h-30 resize-none"
                            wire:model="description">
                          </textarea>
                    </div>
                    <div class=" flex justify-around items-center p-2 gap-4">
                        <button type="button" wire:click="toggleModal('createAnimal', 'close')"
                                class="text-cta font-bold border-2 border-solid border-cta rounded-lg p-2 w-full  hover:bg-gray-100">
                            Annuler la fiche
                        </button>
                        <span
                            wire:loading
                            wire:target="createAnimalinDB"
                            class="flex items-center justify-center gap-2"
                        >
        <svg class="animate-spin h-5 w-5 text-white"
             xmlns="http://www.w3.org/2000/svg"
             fill="none"
             viewBox="0 0 24 24">
            <circle class="opacity-25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4">
            </circle>
            <path class="opacity-75"
                  fill="currentColor"
                  d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
            </path>
        </svg>
        Création en cours…
    </span>
                        <button wire:loading.attr="disabled"
                                wire:target="createAnimalinDB,avatar,avatar_path" type="submit"
                                class="text-white font-bold bg-cta rounded-lg p-2 w-full border-2 border-cta hover:bg-hover">
                            Ajouter une fiche animale
                        </button>
                    </div>
                </form>
            </x-slot:body>
        </x-partials.modal>
    </div>
    <div class="{{ $showEditModal ? 'block' : 'hidden' }}">
        <x-partials.modal>
            <div class="flex justify-around">
                <x-slot:title>
                    Modifier un animal
                    <button type="button" wire:click="toggleModal('openEditModal', 'close')" class="p-2">
                        <img src="{{ asset('svg/close.svg') }}" alt="croix" height="30" width="30">
                    </button>
                </x-slot:title>
            </div>
            <x-slot:body>
                <form wire:submit.prevent="editAnimal" class="space-y-2" enctype="multipart/form-data">
                    <div>
                        <label for="avatar">Choisir l’avatar</label>
                        <input type="file" wire:key="avatar-input" wire:model="avatar"
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text" id="avatar" name="avatar">
                    </div>
                    <div>
                        <label for="avatar_path">Choisir les avatars</label>
                        <input type="file" multiple wire:key="avatar_path-input" wire:model="avatar_path"
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text" id="avatar_path"
                               name="avatar_path[]">
                    </div>
                    <div>
                        <label for="name" id="name"> Nom </label>
                        <input wire:model="name" class="mt-1 w-full bg-background rounded-lg pl-2 font-text" type="text"
                               id="name"
                               name="name">
                    </div>
                    <div class="flex justify-between gap-4 ">
                        <div class="flex flex-col">
                            <label for="specie" id="specie">{{ __('modal.specie') }}</label>
                            <select wire:model="specie" id="specie" name="specie"
                                    class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                                <option value="">Choisir une espèce</option>
                                <option value="dog">chien</option>
                                <option value="cat">chat</option>
                                <option value="birds">oiseau</option>
                                <option value="bunny">lapin</option>
                                <option value="rat">rat</option>
                                <option value="ferret">furet</option>
                            </select>
                        </div>
                        <div class="flex flex-col">
                            <label for="breed" id="breed">Race</label>
                            <input wire:model="breed" type="text" id="breed" name="breed"
                                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                        </div>
                        <div class="flex flex-col">
                            <label for="gender" id="gender">Genre</label>
                            <select class="mt-1 w-full bg-background rounded-lg pl-2 font-text" wire:model="gender">
                                <option value="1">Mâle</option>
                                <option value="0">Femelle</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="age" id="age">Date de naissance}</label>
                        <input wire:model="age" type="date" id="age" name="age"
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                    </div>
                    <div>
                        <label for="status">Statut</label>
                        <select wire:model="status" class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                            <option value="">Choisir un statut</option>
                            <option value="disponible">Disponible</option>
                            <option value="en attente">En attente</option>
                            <option value="en soins">En soins</option>
                            <option value="adopté(e)">Adopté(e)</option>
                        </select>
                    </div>
                    <div>
                        <div>
                            <label for="adoption_start">Date début adoption (optionnelle)</label>
                            <input type="date" wire:model="adoptionStartDate" id="adoption_start"
                                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                            <label for="closed_at">Date clôture adoption</label>
                            <input type="date" wire:model="adoptionClosedAt" id="closed_at"
                                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                        </div>
                    </div>
                    <div>
                        <label for="status" id="status">Vaccin</label>
                        <select class="mt-1 w-full bg-background rounded-lg pl-2 font-text" wire:model="vaccine">
                            <option value="">Choisir une option</option>
                            <option value="1">Vacciné</option>
                            <option value="0">Pas de vaccin</option>
                        </select>
                    </div>
                    <div>
                        <label for="description" id="description">Description</label>
                        <textarea
                            id="description"
                            class="mt-1 w-full bg-background rounded-lg pl-2 font-text h-30 resize-none"
                            wire:model="description">
                          </textarea>
                        <div class="flex justify-around items-center p-2 gap-4">
                            <button type="button" wire:click="toggleModal('openEditModal', 'close')"
                                    class="text-cta font-bold border-2 border-solid border-cta rounded-lg p-2 w-full hover:bg-gray-100">
                                Annuler
                            </button>
                            <button type="submit"
                                    class="text-white font-bold bg-cta rounded-lg p-2 w-full border-2 border-cta hover:bg-hover">
                                Enregistrer
                            </button>
                        </div>
                    </div>
                </form>
            </x-slot:body>
        </x-partials.modal>
    </div>
</main>
