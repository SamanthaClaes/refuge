
<div>
    <x-header.side-bar/>
    <main class="bg-background">
        <x-header.search-bar/>

        <div class="pl-4 md:pl-72 pr-4 md:pr-12 grid grid-cols-1 md:grid-cols-4 gap-4">


            <div>
                <x-cards.dashboard_card number="2" title="Demandes d'adoptions" svg="bell" route="{{ route('admin.messages') }}" />
            </div>

            <div>
                <x-cards.dashboard_card number="3" title="Messages non lus" svg="mail" route="{{ route('admin.messages') }}"/>
            </div>

            <div>
                <x-cards.dashboard_card number="34" title="Bénévoles" svg="user" route="{{ route('admin.planning') }}"/>
            </div>

            <div>
                <x-cards.dashboard_card number="1250" title="Animaux" svg="animals" route="{{ route('admin.animals') }}"/>
            </div>

        </div>
        <section class="row-start-2 col-span-12 mt-8 px-4 md:pl-72">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                <h2 class="font-semibold text-text text-xl pb-4 md:pb-0">{{__()}}</h2>
                <x-cta.add title="{{ __('animals.cta') }}"/>
            </div>

            <div class="p-4 bg-element rounded-2xl overflow-x-auto">
                <table class="min-w-full border-1">
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
                    <tr>
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

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mt-8 mb-4">
                <h2 class="font-semibold text-text text-xl pb-4 md:pb-0">Liste de nos bénévoles</h2>
                <x-cta.add title="+ Ajouter un bénévole " class="mt-2 md:mt-0"/>
            </div>

            <div class="p-4 bg-element rounded-2xl overflow-x-auto">
                <table class="min-w-full border-1">
                    <thead>
                    <tr class="bg-gray-50 border-b-1">
                        <th class="border-r-1 px-2 py-2">Nom</th>
                        <th class="border-r-1 px-2 py-2">Tâches</th>
                        <th class="border-r-1 px-2 py-2">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="px-2 py-2 border-r-1 border-b-1">Chloé</td>
                        <td class="px-2 py-2 border-r-1 border-b-1">Nettoyer la litière des chats</td>
                        <td class="px-2 py-2 border-r-1 border-b-1">
                            <x-SVG.pen/>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-2 py-2 border-r-1">Thomas</td>
                        <td class="px-2 py-2 border-r-1">Promener les chiens</td>
                        <td class="px-2 py-2 border-r-1 border-b-1">
                            <x-SVG.pen/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-8">
                <h2 class="font-semibold text-text text-xl pb-4">Statistiques du mois</h2>
                <canvas id="animalsChart" class="w-full h-64"></canvas>
            </div>
        </section>

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
    </main>

</div>
