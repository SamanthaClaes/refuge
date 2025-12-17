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
                                    {{ $adoption->animal->race }}
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
                                    <x-svg.pen wire="editAnimal"/>
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
            <div class="flex justify-between items-center mt-8">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">{{ __('animals.careAnimals') }}</h2>
                <x-cta.add title="{{ __('animals.cta') }}"/>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <table class="border-1 w-full">
                    <thead>
                    <tr class="bg-background border-b-1">
                        <th class="border-r-1">{{__('animals.name')}}</th>
                        <th class="border-r-1">{{ __('animals.specie') }}</th>
                        <th class="border-r-1">{{ __('animals.gender') }}</th>
                        <th class="border-r-1"> {{ __('animals.adoption_date') }}</th>
                        <th class="border-r-1">{{ __('animals.file') }}</th>
                        <th class="border-r-1">{{ __('animals.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($this->animals as $key => $animal)
                        <tr>
                            <td class="bg-white px-4 py-4 border-r-1 border-b-1">{{ $animal->name }}</td>
                            <td class="bg-white px-4 py-4 border-r-1 border-b-1">{{ $animal->specie }}</td>
                            <td class="bg-white px-4 py-4 border-r-1 border-b-1">{{ $animal->breed }}</td>
                            <td class="bg-white px-4 py-4 border-r-1 border-b-1">{{ $animal->status }}</td>
                            <td class="bg-white px-4 py-4 border-r-1 border-b-1">{{ $animal->file }}</td>
                            <td class="bg-white px-4 py-4 border-r-1 border-b-1">
                                <x-SVG.pen/>
                            </td>
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
                        <tr>
                            <td class="bg-white px-4 py-4 border-r-1 border-b-1">{{ $adoption->animal->name }}</td>
                            <td class="bg-white px-4 py-4 border-r-1 border-b-1">{{ __('animals'. $adoption->animal->specie) }}</td>
                            <td class="bg-white px-4 py-4 border-r-1 border-b-1">{{ $adoption->animal->gender ? 'Mâle' : "femelle" }}</td>
                            <td class="bg-white px-4 py-4 border-r-1 border-b-1">{{ $adoption->closed_as_string }}</td>
                            <td class="bg-white px-4 py-4 border-r-1 border-b-1">{{ $adoption->file }}</td>
                            <td class="bg-white px-4 py-4 border-r-1 border-b-1">
                                <x-SVG.pen/>
                            </td>
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
                        <label for="avatar">Changer l’avatar</label>
                        <input type="file" wire:key="avatar-input" wire:model="avatar"
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text" id="avatar" name="avatar">
                    </div>
                    <div>
                        <label for="avatar_path">Changer les avatars</label>
                        <input type="file"  multiple  wire:key="avatar_path-input" wire:model="avatar_path"
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text" id="avatar_path" name="avatar_path[]">
                    </div>
                    <div>
                        <label for="name" id="name"> {{ __('modal.name') }}</label>
                        <input wire:model="name" class="mt-1 w-full bg-background rounded-lg pl-2 font-text" type="text"
                               id="name"
                               name="name">
                    </div>
                    <div class="flex justify-around gap-4 ">
                        <div class="flex flex-col">
                            <label for="especes" id="espece">{{ __('modal.specie') }}</label>
                            <input wire:model="species" class="mt-1 w-full bg-background rounded-lg pl-2 font-text"
                                   type="text" id="espece"
                                   name="especes">
                        </div>
                        <div class="flex flex-col">
                            <label for="breed" id="breed">{{ __('modal.breed') }}</label>
                            <input wire:model="breed" type="text" id="breed" name="breed"
                                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                        </div>
                        <div class="flex flex-col">
                            <label for="gender" id="gender">Genre</label>
                            <select class="mt-1 w-full bg-background rounded-lg pl-2 font-text" wire:model="gender">
                                <option value="male">Mâle</option>
                                <option value="female">Femelle</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="age" id="age">{{ __('modal.age') }}</label>
                        <input wire:model="age" type="text" id="age" name="age"
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                    </div>
                        <div>
                            <label for="status" id="status">{{ __('modal.status') }}</label>
                            <select class="mt-1 w-full bg-background rounded-lg pl-2 font-text" wire:model="status">
                                <option value="">Sélectionner</option>
                                <option value="disponible" {{ old('status', $animal->status ?? '') == 'available' ? 'selected' : '' }}>
                                    Disponible
                                </option>
                                <option value="en cours" {{ old('status', $animal->status ?? '') == 'ongoing' ? 'selected' : '' }}>
                                    En attente
                                </option>
                                <option value="en soins" {{ old('status', $animal->status ?? '') == 'inCare' ? 'selected' : '' }}>
                                   En soin
                                </option>
                                <option value="en soins" {{ old('status', $animal->status ?? '') == 'adopted' ? 'selected' : '' }}>
                                    Adopté
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="status" id="status">{{ __('modal.vaccine') }}</label>
                            <select class="mt-1 w-full bg-background rounded-lg pl-2 font-text" wire:model="vaccine">
                                <option value="vacciné">Vacciné</option>
                                <option value="non vacciné">Pas de vaccin</option>
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
                    {{ __('modal.edit') }}
                    <button type="button" wire:click="toggleModal('openEditModal', 'close')" class="p-2">
                        <img src="{{ asset('svg/close.svg') }}" alt="croix" height="30" width="30">
                    </button>
                </x-slot:title>
            </div>
            <x-slot:body>
                <form wire:submit.prevent="editAnimal" class="space-y-2" enctype="multipart/form-data">
                    <div>
                        <label for="avatar">Changer l'avatar</label>
                        <input type="file" wire:key="avatar-input" wire:model="avatar"
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text" id="avatar" name="avatar">
                    </div>
                    <div>
                        <label for="avatar_path">Changer les avatars</label>
                        <input type="file" multiple   wire:key="avatar_path-input" wire:model="avatar_path"
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text" id="avatar_path" name="avatar_path[]">
                    </div>
                    <div>
                        <label for="name">{{ __('modal.name') }}</label>
                        <input wire:model="name" class="mt-1 w-full bg-background rounded-lg pl-2 font-text" type="text"
                               id="name" name="name">
                    </div>
                    <div class="flex justify-around gap-4">
                        <div class="flex flex-col flex-1">
                            <label for="breed">{{ __('modal.breed') }}</label>
                            <input wire:model="breed" type="text" id="breed" name="breed"
                                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                        </div>

                        <div class="flex flex-col flex-1">
                            <label for="species">{{ __('modal.specie') }}</label>
                            <input wire:model="species" class="mt-1 w-full bg-background rounded-lg pl-2 font-text"
                                   type="text" id="species" name="species">
                        </div>
                        <div class="flex flex-col">
                            <label for="gender" id="gender">Genre</label>
                            <select class="mt-1 w-full bg-background rounded-lg pl-2 font-text" wire:model="gender">
                                <option value="">Sélectionner</option>
                                <option value="1">Mâle</option>
                                <option value="0">Femelle</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="age">{{ __('modal.age') }}</label>
                        <input wire:model="age" type="number" id="age" name="age"
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                    </div>
                    <div class="space-y-2">
                        <div>
                            <label for="status">{{ __('modal.status') }}</label>
                            <select class="mt-1 w-full bg-background rounded-lg pl-2 font-text" wire:model="status"
                                    id="status">
                                <option value="">Sélectionner</option>
                                <option value="available">Disponible</option>
                                <option value="pending">En attente</option>
                                <option value="in_care">En soins</option>
                                <option value="adopted">Adopté(e)</option>
                            </select>
                        </div>
                        <div>
                            <label for="vaccine">{{ __('modal.vaccine') }}</label>
                            <select class="mt-1 w-full bg-background rounded-lg pl-2 font-text" wire:model="vaccine"
                                    id="vaccine">
                                <option value="1">Vacciné</option>
                                <option value="0">Pas de vaccin</option>
                            </select>
                        </div>
                        <div>
                            <label for="description" id="description">Description</label>
                            <textarea class="mt-1 w-full bg-background rounded-lg pl-2 font-text h-30 resize-none" wire:model="description">
                          </textarea>
                        </div>
                    </div>
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
