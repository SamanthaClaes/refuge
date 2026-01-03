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
                    <div class="rounded-lg overflow-clip">
                        <table class="w-full">
                            <thead class="border-b-1">
                            <tr class="bg-background">
                                <th class="border-r-1">Nom</th>
                                <th class="border-r-1">Email</th>
                                <th class="border-r-1">Téléphone</th>
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
                                    <x-table.table-data>
                                        <x-svg.penUser :user-id="$user->id" :key="$key"/>
                                        <x-svg.delete :animal-id="$user->id"
                                                      wire:click="deleteVolunteer({{ $user->id }})"
                                                      wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $user->name }} ?"/>
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
                    <div class="rounded-lg overflow-clip border-1">
                        <table class="w-full">
                            <thead class="">
                            <tr class="bg-background">
                                <th class="p-3 border-r-1">Nom</th>
                                <th class="p-3 border-r-1">Lundi</th>
                                <th class="p-3 border-r-1">Mardi</th>
                                <th class="p-3 border-r-1"> Mercredi</th>
                                <th class="p-3 border-r-1">Jeudi</th>
                                <th class="p-3 rounded-l-lg border-r-1">Vendredi</th>
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
                                    <x-table.table-data>
                                        <x-svg.penUser :user-id="$user->id" :key="$key"/>
                                    </x-table.table-data>
                                </tr>

                            </tbody>
                            @empty
                                <p> Pad de bénévoles</p>
                            @endforelse
                        </table>
                    </div>
                </section>
            </section>
        </div>
        <div class="{{ $showCreateVolunteerModal ? 'block' : 'hidden' }}">
            <x-partials.modal>
                <div class="flex justify-around">
                    <x-slot:title>
                        Ajouter une fiche bénévole
                        <button type="button" wire:click="toggleModal('createVolunteer', 'close')" class="p-2">
                            <img src="{{ asset('svg/close.svg') }}" alt="croix" height="30" width="30">
                        </button>
                    </x-slot:title>
                </div>
                <x-slot:body>
                    <form wire:submit.prevent="createVolunteerInDb" class="space-y-2"
                          enctype="multipart/form-data">
                        <div>
                            <label for="name" id="name"> {{ __('modal.name') }}</label>
                            <input wire:model="name" class="mt-1 w-full bg-background rounded-lg pl-2 font-text"
                                   type="text"
                                   id="name"
                                   name="name">
                        </div>
                        <div>
                            <label for="email" id="email"> Email </label>
                            <input wire:model="email" class="mt-1 w-full bg-background rounded-lg pl-2 font-text"
                                   type="email"
                                   id="email"
                                   name="email">
                        </div>
                        <div>
                            <label for="phone" id="phone"> Téléphone </label>
                            <input wire:model="phone" class="mt-1 w-full bg-background rounded-lg pl-2 font-text"
                                   type="text"
                                   id="phone"
                                   name="phone">
                        </div>
                        <div class=" flex justify-around items-center p-2 gap-4">
                            <button type="button" wire:click="toggleModal('createVolunteer', 'close')"
                                    class="text-cta font-bold border-2 border-solid border-cta rounded-lg p-2 w-full  hover:bg-gray-100">
                                {{ __('modal.cancelCreation') }}
                            </button>
                            <button type="submit"
                                    class="text-white font-bold bg-cta rounded-lg p-2 w-full border-2 border-cta hover:bg-hover">
                                Ajouter un bénévole
                            </button>
                        </div>
                    </form>
                </x-slot:body>
            </x-partials.modal>
        </div>
        <div class="{{ $showEditVolunteerModal ? 'block' : 'hidden' }}">
            <x-partials.modal>
                <div class="flex justify-around">
                    <x-slot:title>
                        Modifier un bénévole
                        <button type="button" wire:click="toggleModal('editVolunteer', 'close')" class="p-2">
                            <img src="{{ asset('svg/close.svg') }}" alt="croix" height="30" width="30">
                        </button>
                    </x-slot:title>
                </div>
                <x-slot:body>
                    <form wire:submit.prevent="editVolunteer" class="space-y-2" enctype="multipart/form-data">
                        <div>
                            <label for="name" id="name"> {{ __('modal.name') }}</label>
                            <input wire:model="name" class="mt-1 w-full bg-background rounded-lg pl-2 font-text"
                                   type="text"
                                   id="name"
                                   name="name">
                        </div>
                        <div>
                            <label for="email" id="email"> Email </label>
                            <input wire:model="email" class="mt-1 w-full bg-background rounded-lg pl-2 font-text"
                                   type="email"
                                   id="email"
                                   name="email">
                        </div>
                        <div>
                            <label for="phone" id="phone"> Téléphone </label>
                            <input wire:model="phone" class="mt-1 w-full bg-background rounded-lg pl-2 font-text"
                                   type="text"
                                   id="phone"
                                   name="phone">
                        </div>
                        <div class="flex justify-around items-center p-2 gap-4">
                            <button type="button" wire:click="toggleModal('editVolunteer', 'close')"
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
</div>
