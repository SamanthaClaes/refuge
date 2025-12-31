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
                <h2 class="font-semibold text-text text-xl pb-4 md:pb-0">{{ __('animals.allAnimals') }}</h2>
                <x-cta.add title="{{ __('animals.cta') }}"/>
            </div>

            <div class="p-4 bg-element rounded-2xl overflow-x-auto">
                <table class="min-w-full border-1">
                    <thead>
                    <tr class="bg-background border-b-1">
                        <th class="border-r-1">{{ __('animals.name') }}</th>
                        <th class="border-r-1">{{ __('animals.specie') }}</th>
                        <th class="border-r-1">{{ __('animals.gender') }}</th>
                        <th class="border-r-1">{{ __('animals.status') }}</th>
                        <th class="border-r-1">{{ __('animals.file') }}</th>
                        <th class="border-r-1">{{ __('animals.actions') }}</th>
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
                                <x-svg.pen :animal-id="$animal->id" :key="$key"/>
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
                        <th class="border-r-1">{{ __('animals.name') }}</th>
                        <th class="border-r-1">{{ __('animals.specie') }}</th>
                        <th class="border-r-1">{{ __('animals.gender') }}</th>
                        <th class="border-r-1">{{ __('animals.status') }}</th>
                        <th class="border-r-1">Créer par</th>
                        <th class="border-r-1">{{ __('animals.actions') }}</th>
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
                <canvas id="animalsChart" data-chart='@json($this->animalsChartData)'></canvas>
            </div>
        </section>
        <div class="{{ $showCreateAnimalModal ? 'block' : 'hidden' }}">
            <x-partials.modal>
                <x-slot:title>
                    {{ __('modal.add') }}
                    <button type="button" wire:click="toggleModal('createAnimal', 'close')">
                        <img src="{{ asset('svg/close.svg') }}" alt="croix" height="30" width="30">
                    </button>
                </x-slot:title>

                <x-slot:body>
                    <form wire:submit.prevent="createAnimalinDB" enctype="multipart/form-data" class="space-y-2">
                        …
                    </form>
                </x-slot:body>
            </x-partials.modal>
        </div>
    </main>
</div>
