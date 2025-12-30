@php use App\Models\Adoption; @endphp
<main class="bg-background">
    <x-header.search-bar/>
    <div class="pl-72 pr-12 grid grid-cols-12 gap-4">
        <section class="row-start-2 col-span-12">
            <h1 class="sr-only">{{ __('animals.allAnimals') }}</h1>
            <div class="flex justify-between items-center">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">{{ __('animals.allAnimals') }}</h2>
                <x-cta.add title="{{ __('animals.cta') }}"/>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <div class="rounded-lg overflow-clip border-1">
                    <table class="w-full">
                        <thead>
                        <tr class="bg-background">
                            <th class="p-3 border-r-1">{{__('animals.name')}}</th>
                            <th class="p-3 border-r-1">{{ __('animals.specie') }}</th>
                            <th class="p-3 border-r-1">{{ __('animals.gender') }}</th>
                            <th class="p-3 border-r-1"> {{ __('animals.status') }}</th>
                            <th class="p-3 border-r-1">{{ __('animals.file') }}</th>
                            <th class="p-3 rounded-l-lg">{{ __('animals.actions') }}</th>
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
                                                  wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $animal->name }} ?" />
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
            <div class="flex justify-between items-center mt-8">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">{{ __('animals.ongoingAdoption') }}</h2>
                <x-cta.add title="{{ __('animals.cta') }}"/>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <div class="rounded-lg overflow-clip border-1">
                    <table class="w-full">
                        <thead class="border-b-1">
                        <tr class="bg-background">
                            <th class="p-3 border-r-1">{{__('animals.name')}}</th>
                            <th class="p-3 border-r-1">{{ __('animals.specie') }}</th>
                            <th class="p-3 border-r-1">{{ __('animals.gender') }}</th>
                            <th class="p-3 border-r-1"> {{ __('animals.adoption_date') }}</th>
                            <th class="p-3 border-r-1">{{ __('animals.file') }}</th>
                            <th class="p-3 rounded-l-lg">{{ __('animals.actions') }}</th>
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
                                                  wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $animal->name }} ?" />
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
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">{{ __('animals.careAnimals') }}</h2>
                <x-cta.add title="{{ __('animals.cta') }}"/>
            </div>
            </section>
            <div class="p-4 bg-element rounded-2xl">
                <table class="border-1 w-full">
                    <thead>
                    <tr class="bg-background border-b-1">
                        <th class="border-r-1">{{__('animals.name')}}</th>
                        <th class="border-r-1">{{ __('animals.specie') }}</th>
                        <th class="border-r-1">{{ __('animals.gender') }}</th>
                        <th class="border-r-1"> {{ __('animals.status') }}</th>
                        <th class="border-r-1">{{ __('animals.file') }}</th>
                        <th class="border-r-1">{{ __('animals.actions') }}</th>
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
                                              wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $animal->name }} ?" />
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
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">{{ __('animals.adoptedAnimals') }}</h2>
                <x-cta.add title="{{ __('animals.cta') }}"/>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <table class="border-1 w-full">
                    <thead>
                    <tr class="bg-background border-b-1">
                        <th class="border-r-1">{{__('animals.name')}}</th>
                        <th class="border-r-1">{{ __('animals.specie') }}</th>
                        <th class="border-r-1">{{ __('animals.gender') }}</th>
                        <th class="border-r-1"> {{ __('animals.status') }}</th>
                        <th class="border-r-1">{{ __('animals.file') }}</th>
                        <th class="border-r-1">{{ __('animals.actions') }}</th>
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
                                              wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $animal->name }} ?" />
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
                    {{ __('modal.add') }}
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
                        <label for="name" id="name"> {{ __('modal.name') }}</label>
                        <input wire:model="name" class="mt-1 w-full bg-background rounded-lg pl-2 font-text" type="text"
                               id="name"
                               name="name">
                    </div>
                    <div class="flex justify-between gap-4 ">
                        <div class="flex flex-col">
                            <label for="specie" id="specie">{{ __('modal.specie') }}</label>
                            <select wire:model="specie" id="specie" name="specie"
                                    class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                                <option value="">{{ __('animals.select_specie') }}</option>
                                <option value="dog">{{ __('animals.dog') }}</option>
                                <option value="cat">{{ __('animals.cat') }}</option>
                                <option value="birds">{{ __('animals.bird') }}</option>
                                <option value="bunny">{{ __('animals.rabbit') }}</option>
                                <option value="rat">{{ __('animals.rat') }}</option>
                                <option value="ferret">furet</option>
                            </select>
                        </div>
                        <div class="flex flex-col">
                            <label for="breed" id="breed">{{ __('modal.breed') }}</label>
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
                        <label for="age" id="age">{{ __('modal.age') }}</label>
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
                    </div>
                    <div class=" flex justify-around items-center p-2 gap-4">
                        <button type="button" wire:click="toggleModal('createAnimal', 'close')"
                                class="text-cta font-bold border-2 border-solid border-cta rounded-lg p-2 w-full  hover:bg-gray-100">
                            {{ __('modal.cancelCreation') }}
                        </button>
                        <button type="submit"
                                class="text-white font-bold bg-cta rounded-lg p-2 w-full border-2 border-cta hover:bg-hover">
                            {{ __('modal.add') }}
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
                        <label for="name" id="name"> {{ __('modal.name') }}</label>
                        <input wire:model="name" class="mt-1 w-full bg-background rounded-lg pl-2 font-text" type="text"
                               id="name"
                               name="name">
                    </div>
                    <div class="flex justify-between gap-4 ">
                        <div class="flex flex-col">
                            <label for="specie" id="specie">{{ __('modal.specie') }}</label>
                            <select wire:model="specie" id="specie" name="specie"
                                    class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                                <option value="">{{ __('animals.select_specie') }}</option>
                                <option value="dog">{{ __('animals.dog') }}</option>
                                <option value="cat">{{ __('animals.cat') }}</option>
                                <option value="birds">{{ __('animals.bird') }}</option>
                                <option value="bunny">{{ __('animals.rabbit') }}</option>
                                <option value="rat">{{ __('animals.rat') }}</option>
                            </select>
                        </div>
                        <div class="flex flex-col">
                            <label for="breed" id="breed">{{ __('modal.breed') }}</label>
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
                        <label for="age" id="age">{{ __('modal.age') }}</label>
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
                        <button type="button" wire:click="toggleModal('openEditModal', 'close')"
                                class="text-cta font-bold border-2 border-solid border-cta rounded-lg p-2 w-full hover:bg-gray-100">
                            Annuler
                        </button>
                        <button type="submit"
                                class="text-white font-bold bg-cta rounded-lg p-2 w-full border-2 border-cta hover:bg-hover">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </x-slot:body>
        </x-partials.modal>
    </div>
</main>
