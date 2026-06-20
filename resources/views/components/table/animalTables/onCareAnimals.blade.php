@props(['animals'])

<div class="p-4 bg-element rounded-2xl">
    <table class="border w-full">
        <thead>
        <tr class="bg-background">
            <th class="p-3 border-r">Nom</th>
            <th class="p-3 border-r">Espèce</th>
            <th class="p-3 border-r">Genre</th>
            <th class="p-3 border-r">Date d’adoption</th>
            <th class="p-3 border-r">Fiche</th>
            <th class="p-3 rounded-l-lg">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse($animals as $animal)
            <tr class="rounded">
                <x-table.table-data>
                    {{ $animal->name }}
                </x-table.table-data>

                <x-table.table-data>
                    {{ $animal->breed }}
                </x-table.table-data>

                <x-table.table-data>
                    {{ $animal->gender ? 'Mâle' : 'Femelle' }}
                </x-table.table-data>

                <x-table.table-data>
                    {{ $animal->status }}
                </x-table.table-data>

                <x-table.table-data>
                    {{ $animal->file ? 'validée' : 'à valider' }}
                </x-table.table-data>

                <x-table.table-data>
                    <x-svg.pen :animal-id="$animal->id"/>

                    <x-svg.delete
                        :animal-id="$animal->id"
                        wire:click="deleteAnimal({{ $animal->id }})"
                        wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $animal->name }} ?"
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

<div class="mt-6 mb-12 flex justify-center">
    <div class="bg-element rounded-xl px-4 py-3 shadow-sm">
        {{ $animals->links('vendor.pagination.livewire-tailwind') }}
    </div>
</div>
