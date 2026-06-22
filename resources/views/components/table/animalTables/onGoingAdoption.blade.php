@props(['adoptions'])

<div class="p-4 bg-element rounded-2xl">
    <div class="rounded-lg overflow-clip border">
        <table class="w-full">
            <thead class="border-b">
            <tr class="bg-background">
                <th class="p-3 border-r">Nom</th>
                <th class="p-3 border-r">Espèce</th>
                <th class="p-3 border-r">Genre</th>
                <th class="p-3 border-r">Date de début d’adoption</th>
                <th class="p-3 rounded-l-lg">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($adoptions as $adoption)
                <tr class="rounded">
                    <x-table.table-data>
                        {{ $adoption->animal?->name ?? '—' }}
                    </x-table.table-data>

                    <x-table.table-data>
                        {{ $adoption->animal?->breed ?? '—' }}
                    </x-table.table-data>

                    <x-table.table-data>
                        {{ $adoption->animal?->gender === null ? '—' : ($adoption->animal->gender ? 'Mâle' : 'Femelle') }}
                    </x-table.table-data>

                    <x-table.table-data>
                        {{ $adoption->started_at->locale('fr')->translatedFormat(' d F Y') }}
                    </x-table.table-data>
                    <x-table.table-data is-last="true">
                        <div x-data="{ open: false }" class="flex justify-center">

                            <button
                                type="button"
                                @click="open = !open"
                                class="px-3 py-1 rounded bg-element hover:bg-hover cursor-pointer"
                            >
                                ⋮
                            </button>

                            <div
                                x-show="open"
                                @click.outside="open = false"
                                x-cloak
                                class="absolute right-0 mt-2 w-40 bg-white border rounded-lg shadow-lg z-50"
                            >
                                <button
                                    type="button"
                                    wire:click="openEditModal({{ $adoption->animal?->id }})"
                                    class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                                >
                                    Modifier
                                </button>

                                <button
                                    type="button"
                                    wire:click="deleteAnimal({{ $adoption->animal?->id }})"
                                    wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $adoption->animal?->name ?? 'cet animal' }} ?"
                                    class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100"
                                >
                                    Supprimer
                                </button>
                            </div>

                        </div>
>>>>>>> Stashed changes
                    </x-table.table-data>
                </tr>
            @empty
                <tr class="rounded">
                    <td class="bg-white p-3 text-center" colspan="6">
                        Pas d’animaux trouvés
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6 mb-12 flex justify-center">
    <div class="bg-element rounded-xl px-4 py-3 shadow-sm">
        {{ $adoptions->links('vendor.pagination.livewire-tailwind') }}
    </div>
</div>
