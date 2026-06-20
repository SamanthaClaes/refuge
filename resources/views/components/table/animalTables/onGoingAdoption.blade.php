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

                    <x-table.table-data>
                        <x-svg.pen :animal-id="$adoption->animal?->id" />

                        <x-svg.delete
                            :animal-id="$adoption->id"
                            wire:click="deleteAnimal({{ $adoption->animal?->id }})"
                            wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $adoption->animal?->name ?? 'cet animal' }} ?"
                        />
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
