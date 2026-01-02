<?php
$title = 'Dashboard TEST';
?>
<div>
    <x-header.side-bar/>
    <main class="bg-background">
        <div class="pl-72 pr-12 pt-8 pb-10 flex items-center">
            <label for="search" class="sr-only">Rechercher un animal</label>
            <div class="relative">
                <input wire:model.live.debounce.500ms="searchBar" type="search" name="search" id="search"
                       placeholder="Trouvez un animal"
                       class="w-full px-4 py-2 bg-element rounded-lg font-text text-xs md:text-xl bg-[url('svg/search.svg')] bg-no-repeat bg-right pr-8">
                <svg class="absolute top-[50%] transform-[translateY(-50%)] right-2 w-[24px] h-[24px]"
                     xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                    <path
                        d="M42 42L33.3 33.3M38 22C38 30.8366 30.8366 38 22 38C13.1634 38 6 30.8366 6 22C6 13.1634 13.1634 6 22 6C30.8366 6 38 13.1634 38 22Z"
                        stroke="#4B2E1D" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <div class="pl-4 md:pl-72 pr-4 md:pr-12 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <x-cards.dashboard_card :number="$unreadCount ?? 0" title="Messages non lus" svg="mail"
                                        route="{{ route('admin.messages') }}"/>
            </div>
            <div>
                <x-cards.dashboard_card :number="$unreadAdoptionRequestsCount ?? 0" title="Demandes non lues" svg="mail"
                                        route="{{ route('admin.messages') }}"/>
            </div>
            <div>
                <x-cards.dashboard_card :number="$this->volunteersCount" title="Bénévoles" svg="user"
                                        route="{{ route('admin.planning') }}"/>
            </div>
            <div>
                <x-cards.dashboard_card :number="$this->animalsCount" title="Animaux" svg="animals"
                                        route="{{ route('admin.animals') }}"/>
            </div>
        </div>

        <section class="row-start-2 col-span-12 mt-8 px-4 md:pl-72">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                <h2 class="font-semibold text-text text-xl pb-4 md:pb-0">Liste de tous les animaux</h2>
                <x-cta.add title="+ Ajouter un animal"/>
            </div>

            <div class="p-4 bg-element rounded-2xl overflow-x-auto">
                <table class="min-w-full border-1">
                    <thead>
                    <tr class="bg-background border-b-1">
                        <th class="border-r-1">Nom</th>
                        <th class="border-r-1">Espèce</th>
                        <th class="border-r-1">Genre</th>
                        <th class="border-r-1">Statut</th>
                        <th class="border-r-1">Fiche</th>
                        <th class="border-r-1">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($this->animals as $key => $animal)
                        <tr>
                            <x-table.table-data>{{ $animal->name }}
                            </x-table.table-data>
                            <x-table.table-data>{{ $animal->breed }}
                            </x-table.table-data>
                            <x-table.table-data>{{ $animal->gender ? 'Mâle' : 'Femelle' }}
                            </x-table.table-data>
                            <x-table.table-data>{{ $animal->status }}
                            </x-table.table-data>
                            <x-table.table-data>{{ $animal->file ? 'validée' : 'à valider' }}
                            </x-table.table-data>
                            <x-table.table-data>
                                <x-svg.penDashboard :animal-id="$animal->id" :key="$key"/>
                                <x-svg.delete :animal-id="$animal->id"
                                              wire:click="deleteAnimal({{ $animal->id }})"
                                              wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $animal->name }} ?"/>
                            </x-table.table-data>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="bg-white p-3">Pas d’animaux trouvés</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mt-8 mb-4">
                <h2 class="font-semibold text-text text-xl pb-4 md:pb-0">Fiches en attente de validation</h2>
            </div>

            <div class="p-4 bg-element rounded-2xl overflow-x-auto">
                <table class="min-w-full border-1">
                    <thead>
                    <tr class="bg-gray-50 border-b-1">
                        <th class="border-r-1">Nom</th>
                        <th class="border-r-1">Espèce</th>
                        <th class="border-r-1">Genre</th>
                        <th class="border-r-1">Statut</th>
                        <th class="border-r-1">Créer par</th>
                        <th class="border-r-1">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($this->pendingAnimals as $animal)
                        <tr>
                            <x-table.table-data>{{ $animal->name }}</x-table.table-data>
                            <x-table.table-data>{{ $animal->specie }}</x-table.table-data>
                            <x-table.table-data>{{ $animal->gender ? 'Mâle' : 'Femelle' }}</x-table.table-data>
                            <x-table.table-data>{{ $animal->status }}</x-table.table-data>
                            <x-table.table-data>{{ $animal->creator->name ?? 'Inconnu' }}</x-table.table-data>
                            <x-table.table-data>
                                @if( auth()->user()->isAdmin())
                                    <button wire:click="validateAnimal({{ $animal->id }})">Valider</button>
                                @endif
                                <button wire:click="deleteAnimal({{ $animal->id }})">Supprimer</button>
                            </x-table.table-data>
                        </tr>
                    @empty
                        <tr>
                            <td class="bg-white p-3" colspan="6">Pas de fiches en attente</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if( auth()->user()->isAdmin())
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mt-8 mb-4">
                    <h2 class="font-semibold text-text text-xl pb-4 md:pb-0">Liste de nos bénévoles</h2>
                </div>

                <div class="p-4 bg-element rounded-2xl overflow-x-auto">
                    <table class="min-w-full border-1">
                        <thead>
                        <tr class="bg-gray-50 border-b-1">
                            <th class="border-r-1 px-2 py-2">Nom</th>
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
            @endif

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4 mt-8" wire:ignore>
                <h2 class="font-semibold text-text text-xl pb-4">Statistiques du mois</h2>
                <button class="bg-cta p-2 h-10 rounded-xl text-white hover:bg-hover cursor-pointer px-4">Exporter en
                    PDF
                </button>
            </div>

            <div wire:ignore>
                <canvas id="animalsChart" data-chart='@json($this->animalsChartData)'>
                </canvas>
            </div>
        </section>
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
                            <label for="name" id="name"> Nom</label>
                            <input wire:model="name" class="mt-1 w-full bg-background rounded-lg pl-2 font-text" type="text"
                                   id="name"
                                   name="name">
                        </div>
                        <div class="flex justify-between gap-4 ">
                            <div class="flex flex-col">
                                <label for="specie" id="specie">Espèces</label>
                                <select wire:model="specie" id="specie" name="specie"
                                        class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                                    <option value="">Sélectionner une espèce</option>
                                    <option value="dog">Chien</option>
                                    <option value="cat">Chat</option>
                                    <option value="birds">Oiseaux</option>
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
                            <label for="age" id="age">Age</label>
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
                                <input type="date" wire:model="adoptionClosedAt" id="closed_at"  class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                            </div>
                        </div>
                        <div>
                            <label for="status" id="status">Vaccins</label>
                            <select class="mt-1 w-full bg-background rounded-lg pl-2 font-text" wire:model="vaccine">
                                <option value="">Choisir une option</option>
                                <option value="1">Vacciné(e)</option>
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
                            <button type="submit"
                                    class="text-white font-bold bg-cta rounded-lg p-2 w-full border-2 border-cta hover:bg-hover">
                                Ajouter la fiche animale
                            </button>
                        </div>
                    </form>
                </x-slot:body>
            </x-partials.modal>
        </div>
        <div class="{{ $showEditAnimalModal ? 'block' : 'hidden' }}">
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
                            <label for="name" id="name"> Nom</label>
                            <input wire:model="name" class="mt-1 w-full bg-background rounded-lg pl-2 font-text" type="text"
                                   id="name"
                                   name="name">
                        </div>
                        <div class="flex justify-between gap-4 ">
                            <div class="flex flex-col">
                                <label for="specie" id="specie">Espèce</label>
                                <select wire:model="specie" id="specie" name="specie"
                                        class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                                    <option value="">Choisir une espèce</option>
                                    <option value="dog">Chien</option>
                                    <option value="cat">Chat</option>
                                    <option value="birds">Oiseaux</option>
                                    <option value="bunny">Lapin</option>
                                    <option value="rat">Rat</option>
                                    <option value="rat">Furet</option>
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
                            <label for="age" id="age">Age</label>
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
                                <input type="date" wire:model="adoptionClosedAt" id="closed_at"  class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                            </div>
                        </div>
                        <div>
                            <label for="status" id="status">{{ __('modal.vaccine') }}</label>
                            <select class="mt-1 w-full bg-background rounded-lg pl-2 font-text" wire:model="vaccine">
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
                                <button type="button" wire:click="toggleModal('editAnimal', 'close')"
                                        class="text-cta font-bold border-2 border-solid border-cta rounded-lg p-2 w-full hover:bg-gray-100">
                                    Annuler les modifications
                                </button>
                                <button type="submit"
                                        class="text-white font-bold bg-cta rounded-lg p-2 w-full border-2 border-cta hover:bg-hover">
                                    Enregistrer les modifications
                                </button>
                            </div>
                        </div>
                    </form>
                </x-slot:body>
            </x-partials.modal>
        </div>
    </main>
</div>
