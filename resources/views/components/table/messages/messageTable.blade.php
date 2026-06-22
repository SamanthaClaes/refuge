@props([
    'items',
    'type'
])

@if($type === 'messages')

    <div class="p-4 bg-element rounded-2xl">
        <table class="border w-full">
            <thead>
            <tr class="border-b">
                <th class="border-r">Statut</th>
                <th class="border-r">Nom</th>
                <th class="border-r">Email</th>
                <th class="border-r">Téléphone</th>
                <th class="border-r">Message</th>
                <th class="border-r">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($items as $message)
                <tr class="{{ $message->read ? 'bg-gray-50' : 'bg-blue-50' }}">
                    <x-table.table-data>
                        @if($message->read)
                            <span class="font-semibold text-green-600">
            Lu
        </span>
                        @else
                            <span class="font-semibold text-orange-600">
            Non lu
        </span>
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
                        <button
                            type="button"
                            wire:click="openMessageModal({{ $message->id }})"
                            class="text-cta hover:underline cursor-pointer"
                        >
                            Voir le message
                        </button>
                    </x-table.table-data>
                    <x-table.table-data is-last="true">
                        <div x-data="{ open: false }" class="flex justify-center">

                            <button
                                type="button"
                                @click="open = !open"
                                class="px-3 py-1 rounded bg-element hover:bg-hover text-text cursor-pointer"
                            >
                                ⋮
                            </button>

                            <div
                                x-show="open"
                                @click.outside="open = false"
                                x-cloak
                                class="absolute right-0 mt-2 w-56 bg-white border rounded-lg shadow-lg z-50"
                            >
                                @if($message->read)
                                    <button
                                        wire:click="markMessageAsUnread({{ $message->id }})"
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                                    >
                                        Marquer comme non lu
                                    </button>
                                @else
                                    <button
                                        wire:click="markMessageAsRead({{ $message->id }})"
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                                    >
                                        Marquer comme lu
                                    </button>
                                @endif

                                <button
                                    wire:click="deleteMsg({{ $message->id }})"
                                    wire:confirm="Êtes-vous sûr de vouloir supprimer ce message ?"
                                    class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100"
                                >
                                    Supprimer
                                </button>
                            </div>

                        </div>
                    </x-table.table-data>
                </tr>
            @empty
                <tr class="rounded">
                    <td class="bg-white p-3 text-center" colspan="6">
                        Pas de messages trouvés
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endif
@if( $type === 'adoptions')
    <div class="p-4 bg-element rounded-2xl">
        <table class="border w-full">
            <thead>
            <tr class="border-b">
                <th class="border-r">Statut</th>
                <th class="border-r">Nom</th>
                <th class="border-r">Email</th>
                <th class="border-r">Message</th>
                <th class="border-r">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($items as $request)
                <tr class="{{ $request->read ? 'bg-gray-50' : 'bg-blue-50' }}">
                    <x-table.table-data>
                        <span class="font-semibold {{ $request->read ? 'text-green-600' : 'text-orange-600' }}">
        {{ $request->read ? 'Lu' : 'Non lu' }}
    </span>
                    </x-table.table-data>
                    <x-table.table-data>
                        {{ $request->name }}
                    </x-table.table-data>
                    <x-table.table-data>
                        {{ $request->email }}
                    </x-table.table-data>
                    <x-table.table-data>
                        <button
                            type="button"
                            wire:click="openMessageModal({{ $request->id }})"
                            class="text-cta hover:underline cursor-pointer  "
                        >
                            Voir le message
                        </button>
                    </x-table.table-data>
                    <x-table.table-data>
                        @if($request->status === 'pending')
                            <span class="text-yellow-600 font-semibold cursor-pointer">En attente</span>
                        @elseif($request->status === 'accepted')
                            <span class="text-green-600 font-semibold cursor-pointer">Acceptée</span>
                        @else
                            <span class="text-red-600 font-semibold cursor-pointer">Refusée</span>
                        @endif
                    </x-table.table-data>
                    <x-table.table-data is-last="true">
                        <div x-data="{ open: false }" class="flex justify-center">

                            <button
                                @click="open = !open"
                                class="px-3 py-1 rounded bg-element hover:bg-hover text-text cursor-pointer"
                            >
                                ⋮
                            </button>

                            <div
                                x-show="open"
                                @click.outside="open = false"
                                x-cloak
                                class="absolute right-0 mt-2 w-52 bg-white border rounded-lg shadow-lg z-50"
                            >
                                @if($request->read)
                                    <button
                                        wire:click="markAdoptionAsUnread({{ $request->id }})"
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                                    >
                                        Marquer comme non lu
                                    </button>
                                @else
                                    <button
                                        wire:click="markAdoptionAsRead({{ $request->id }})"
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                                    >
                                        Marquer comme lu
                                    </button>
                                @endif

                                <button
                                    wire:click="acceptAdoption({{ $request->id }})"
                                    class="block w-full text-left px-4 py-2 text-green-600 hover:bg-gray-100"
                                >
                                    Accepter la demande
                                </button>

                                <button
                                    wire:click="refuseAdoption({{ $request->id }})"
                                    class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100"
                                >
                                    Refuser la demande
                                </button>
                            </div>

                        </div>
                    </x-table.table-data>
                </tr>
            @empty
                <tr class="rounded">
                    <td class="bg-white p-3 text-center" colspan="6">
                        Pas de messages trouvés
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endif
