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
                    @forelse($this->animals as $animal)
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
                            <x-table.table-data>
                                <x-svg.pen wire="editAnimal"/>
                            </x-table.table-data>

                        </tr>
                        @empty
                        <p class="text-text">Aucun animal n’a été trouvé</p>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-8">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">{{ __('animals.ongoingAdoption') }}</h2>
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
                    @foreach($this->ongoingAdoptions as $adoption)
                        <tr>
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
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-8">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">{{ __('animals.careAnimals') }}</h2>
                <x-cta.add title="{{ __('animals.cta') }}"/>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <table class="border-1 w-full">
                    <thead>
                    <tr class="bg-gray-50 border-b-1">
                        <th class="border-r-1">{{__('animals.name')}}</th>
                        <th class="border-r-1">{{ __('animals.specie') }}</th>
                        <th class="border-r-1">{{ __('animals.gender') }}</th>
                        <th class="border-r-1"> {{ __('animals.status') }}</th>
                        <th class="border-r-1">{{ __('animals.file') }}</th>
                        <th class="border-r-1">{{ __('animals.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="px-4 py-4 border-r-1 border-b-1">Billy</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Chihuahua</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">En soins</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Validée</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">
                            <x-SVG.pen/>
                        </td>
                    </tr>
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
                    <tr class="bg-gray-50 border-b-1">
                        <th class="border-r-1">{{__('animals.name')}}</th>
                        <th class="border-r-1">{{ __('animals.specie') }}</th>
                        <th class="border-r-1">{{ __('animals.gender') }}</th>
                        <th class="border-r-1"> {{ __('animals.status') }}</th>
                        <th class="border-r-1">{{ __('animals.file') }}</th>
                        <th class="border-r-1">{{ __('animals.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                   @foreach($this->closedAdoptions as $adoption)
                        <tr>
                            <td class="px-4 py-4 border-r-1 border-b-1">{{ $adoption->animal->name }}</td>
                            <td class="px-4 py-4 border-r-1 border-b-1">{{ __('animals'. $adoption->animal->specie) }}</td>
                            <td class="px-4 py-4 border-r-1 border-b-1">{{ $adoption->animal->gender ? 'Mâle' : "femelle" }}</td>
                            <td class="px-4 py-4 border-r-1 border-b-1">{{ $adoption->closed_as_string }}</td>
                            <td class="px-4 py-4 border-r-1 border-b-1">
                                <x-SVG.pen/>
                            </td>
                        </tr>
                    @endforeach
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
                <form  wire:submit.prevent="createAnimalinDB" class="space-y-2" enctype="multipart/form-data" >
                    <div>
                        <label for="avatar">Changer l’avatar</label>
                        <input type="file" wire:key="avatar-input" wire:model="avatar" class="mt-1 w-full bg-background rounded-lg pl-2 font-text" id="avatar" name="avatar">
                    </div>
                    <div>
                        <label for="name" id="name"> {{ __('modal.name') }}</label>
                        <input wire:model="name" class="mt-1 w-full bg-background rounded-lg pl-2 font-text" type="text" id="name"
                               name="name">
                    </div>
                    <div class="flex justify-around gap-4 ">
                        <div class="flex flex-col">
                            <label for="breed" id="breed">{{ __('modal.breed') }}</label>
                            <input wire:model="breed" type="text" id="breed" name="breed"
                                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                        </div>
                        <div class="flex flex-col">
                            <label for="especes" id="espece">{{ __('modal.specie') }}</label>
                            <input wire:model="species" class="mt-1 w-full bg-background rounded-lg pl-2 font-text" type="text" id="espece"
                                   name="especes">
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
                            <option value="disponible">Disponible</option>
                            <option value="en soin">En soins</option>
                            <option value="adoptée">Adopté(e)</option>
                        </select>
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

    @if($showEditAnimalModal)
        <x-partials.modal>
            <div class="flex justify-around">
                <x-slot:title>
                    {{ __('modal.modify') }}
                    <button type="button" wire:click="toggleModal('editAnimal', 'close')" class="p-2 cursor-pointer">
                        <img src="{{ asset('svg/close.svg') }}" alt="croix" height="30" width="30">
                    </button>
                </x-slot:title>
            </div>
            <x-slot:body>
                <form action="#" method="get" class="space-y-2">
                    <div>
                        <label for="name" id="name">{{ __('modal.name') }}</label>
                        <input class="mt-1 w-full bg-background rounded-lg pl-2 font-text" type="text" id="name"
                               name="name">
                    </div>
                    <div class="flex justify-around gap-4 ">
                        <div class="flex flex-col">
                            <label for="breed" id="breed">{{ __('modal.breed') }}</label>
                            <input type="text" id="breed" name="breed"
                                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                        </div>
                        <div class="flex flex-col">
                            <label for="especes" id="espece">{{ __('modal.specie') }}</label>
                            <input class="mt-1 w-full bg-background rounded-lg pl-2 font-text" type="text" id="espece"
                                   name="especes">
                        </div>

                    </div>
                    <div>
                        <label for="age" id="age">{{ __('modal.age') }}</label>
                        <input type="text" id="age" name="age"
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                    </div>
                    <div class=" flex justify-around items-center p-2 gap-4">
                        <button type="button" wire:click="toggleModal('editAnimal', 'close')"
                                class="text-cta font-bold border-2 border-solid border-cta rounded-lg p-2 w-full  hover:bg-gray-100 cursor-pointer">
                            {{ __('modal.cancelModify') }}
                        </button>
                        <button type="button" wire:click="toggleModal('editAnimal', 'close')"
                                class="text-white font-bold bg-cta rounded-lg p-2 w-full border-2 border-cta hover:bg-hover cursor-pointer">
                            {{ __('modal.confirm') }}
                        </button>
                    </div>
                </form>
            </x-slot:body>
        </x-partials.modal>
    @endif
</main>
