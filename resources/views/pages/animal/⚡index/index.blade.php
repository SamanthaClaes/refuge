<main>
    <x-header.search-bar/>
    <div class="pl-72 pr-12 grid grid-cols-12 gap-4">
        <section class="row-start-2 col-span-12">
            <h1 class="sr-only">Liste de tous les animaux</h1>
            <div class="flex justify-between items-center">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste des animaux</h2>
                <x-cta.add/>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <table class="border-1 w-full">
                    <thead>
                    <tr class="bg-background border-b-1">
                        <th class="border-r-1">Nom</th>
                        <th class="border-r-1">Espèce</th>
                        <th class="border-r-1">Genre</th>
                        <th class="border-r-1">Status</th>
                        <th class="border-r-1">Fiche</th>
                        <th class="border-r-1">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($this->animals as $animal)
                        <tr>
                            <x-table.table-data>
                                {{ $animal->name }}
                            </x-table.table-data>
                            <x-table.table-data>
                                {{ $animal->race }}
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
                                <x-svg.pen/>
                            </x-table.table-data>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-8">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste des animaux en cours d'adoption</h2>
                <x-cta.add/>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <table class="border-1 w-full">
                    <thead>
                    <tr class="bg-gray-50 border-b-1">
                        <th class="border-r-1">Nom</th>
                        <th class="border-r-1">Espèce</th>
                        <th class="border-r-1">Adoption</th>
                        <th class="border-r-1">Fiche</th>
                        <th class="border-r-1">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="px-4 py-4 border-r-1 border-b-1">Garfield</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">British shortair</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">En cours</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Validée</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">
                            <x-SVG.pen/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-8">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste des animaux en soins</h2>
                <x-cta.add/>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <table class="border-1 w-full">
                    <thead>
                    <tr class="bg-gray-50 border-b-1">
                        <th class="border-r-1">Nom</th>
                        <th class="border-r-1">Espèce</th>
                        <th class="border-r-1">Adoption</th>
                        <th class="border-r-1">Fiche</th>
                        <th class="border-r-1">Actions</th>
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
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste des animaux adoptés</h2>
                <x-cta.add/>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <table class="border-1 w-full">
                    <thead>
                    <tr class="bg-gray-50 border-b-1">
                        <th class="border-r-1">Nom</th>
                        <th class="border-r-1">Espèce</th>
                        <th class="border-r-1">Adoption</th>
                        <th class="border-r-1">Fiche</th>
                        <th class="border-r-1">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="px-4 py-4 border-r-1 border-b-1">Cookie</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Européen</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Adoptée</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Validée</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">
                            <x-SVG.pen/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    @if($showCreateAnimalModal)
        <x-partials.modal>
            <div class="flex justify-around">
                <x-slot:title>
                    Modifier une fiche animale
                    <button type="button" wire:click="closeModal('createAnimal')" class="p-2">
                        <img src="{{ asset('svg/close.svg') }}" alt="croix" height="30" width="30">
                    </button>
                </x-slot:title>
            </div>
            <x-slot:body>
                <form action="#" method="get" class="space-y-2">
                    <div>
                        <img src="{{ asset('img/animals/portrait.jpg') }}" alt="portrait du chien" width="163"
                             height="163">
                    </div>
                    <div>
                        <label for="name" id="name">Nom</label>
                        <input class="mt-1 w-full bg-background rounded-lg pl-2 font-text" type="text" id="name"
                               name="name">
                    </div>
                    <div class="flex justify-around gap-4 ">
                        <div class="flex flex-col">
                            <label for="race" id="race">Race</label>
                            <input type="text" id="race" name="race"
                                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                        </div>
                        <div class="flex flex-col">
                            <label for="especes" id="espece">Espèces</label>
                            <input class="mt-1 w-full bg-background rounded-lg pl-2 font-text" type="text" id="espece"
                                   name="especes">
                        </div>

                    </div>
                    <div>
                        <label for="age" id="age">Age</label>
                        <input type="text" id="age" name="age"
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                    </div>
                    <div class=" flex justify-around items-center p-2 gap-4">
                        <button type="button" wire:click="closeModal('createAnimal')"
                                class="text-cta font-bold border-2 border-solid border-cta rounded-lg p-2 w-full  hover:bg-gray-100">
                            Annuler les modifications
                        </button>
                        <button type="button" wire:click="closeModal('createAnimal')"
                                class="text-white font-bold bg-cta rounded-lg p-2 w-full border-2 border-cta hover:bg-hover">
                            Modifier les informations
                        </button>
                    </div>
                </form>
            </x-slot:body>
        </x-partials.modal>
    @endif
</main>
