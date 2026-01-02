<div>

    <div>
        <x-layout.guest title="Messages">
            <main>
                <x-header.side-bar/>
                <h1 class="pl-72 mt-8 text-2xl uppercase text-text text-center">Liste des messages</h1>
                <div class="pl-72 pr-12 grid grid-cols-12 gap-4">
                    <section class="row-start-2 col-span-12">
                        <div>
                            <h2 class="pt-8 font-semibold text-text text-xl pb-4 uppercase">Messages non lus</h2>
                        </div>
                        <div class="p-4 bg-element rounded-2xl">
                            <table class="border-1 w-full">
                                <thead>
                                <tr class="border-b-1">
                                    <th class="border-r-1">Statut</th>
                                    <th class="border-r-1">Nom</th>
                                    <th class="border-r-1">Email</th>
                                    <th class="border-r-1">Téléphone</th>
                                    <th class="border-r-1">Message</th>
                                    <th class="border-r-1">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($messages as $message)
                                    <tr class="{{ $message->read ? 'bg-gray-50' : 'bg-blue-50' }}">
                                        <x-table.table-data>
                                            @if($message->read)
                                                <button
                                                    wire:click="markAsUnread({{ $message->id }})"
                                                    class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                                                    title="Marquer comme non lu"
                                                >
                                                     Marquer comme non lu
                                                </button>
                                            @else
                                                <button
                                                    wire:click="markAsRead({{ $message->id }})"
                                                    class="px-3 py-1 text-sm bg-cta text-white rounded hover:bg-hover"
                                                    title="Marquer comme lu"
                                                >
                                                    Marquer comme lu
                                                </button>
                                            @endif
                                        </x-table.table-data>
                                        <x-table.table-data>
                                            {{ $message->name }}
                                        </x-table.table-data>
                                        <x-table.table-data>
                                            {{ $message->email }}
                                        </x-table.table-data>
                                        <x-table.table-data>
                                            {{ $message->phone }}
                                        </x-table.table-data>
                                        <x-table.table-data>
                                            {{ $message->message }}
                                        </x-table.table-data>
                                        <x-table.table-data is-last="true">
                                            <x-svg.delete :messages-id="$message->id"
                                                          wire:click="deleteMsg({{ $message->id }})"
                                                          wire:confirm="Êtes-vous sûr de vouloir supprimer ce message ?" />
                                        </x-table.table-data>
                                    </tr>
                                @empty
                                    <tr class="rounded">
                                        <td class="bg-white p-3" colspan="6">
                                            Pas de messages trouvés
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <h2 class="pt-8 font-semibold text-text text-xl pb-4 uppercase">Demandes d’adoptions</h2>
                        </div>
                        <div class="p-4 bg-element rounded-2xl">
                            <table class="border-1 w-full">
                                <thead>
                                <tr class="border-b-1">
                                    <th class="border-r-1">Statut</th>
                                    <th class="border-r-1">Nom</th>
                                    <th class="border-r-1">Email</th>
                                    <th class="border-r-1">Message</th>
                                    <th class="border-r-1">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($adoptionRequests as $request)
                                    <tr class="{{ $request->read ? 'bg-gray-50' : 'bg-blue-50' }}">
                                        <x-table.table-data>
                                            @if($request->read)
                                                <button
                                                    wire:click="markAdoptionAsUnread({{ $request->id }})"
                                                    class="px-3 py-1 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300"
                                                    title="Marquer comme non lu"
                                                >
                                                    Marquer comme non lu
                                                </button>
                                            @else
                                                <button
                                                    wire:click="markAdoptionAsRead({{ $request->id }})"
                                                    class="px-3 py-1 text-sm bg-cta text-white rounded hover:bg-hover"
                                                    title="Marquer comme lu"
                                                >
                                                    Marquer comme lu
                                                </button>
                                            @endif
                                        </x-table.table-data>
                                        <x-table.table-data>
                                            {{ $request->name }}
                                        </x-table.table-data>
                                        <x-table.table-data>
                                            {{ $request->email }}
                                        </x-table.table-data>
                                        <x-table.table-data>
                                            {{ $request->message }}
                                        </x-table.table-data>
                                        <x-table.table-data is-last="true">
                                                <button
                                                    wire:click="acceptAdoption({{ $request->id }})"
                                                    class="px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700"
                                                >
                                                    Accepter
                                                </button>

                                                <button
                                                    wire:click="refuseAdoption({{ $request->id }})"
                                                    class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700 ml-2"
                                                >
                                                    Refuser
                                                </button>
                                        </x-table.table-data>
                                    </tr>
                                @empty
                                    <tr class="rounded">
                                        <td class="bg-white p-3" colspan="6">
                                            Pas de messages trouvés
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                    </section>
                </div>
            </main>
        </x-layout.guest>

    </div>

</div>
