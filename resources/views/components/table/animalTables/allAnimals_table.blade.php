@props(['animals'])

<div class="p-4 bg-element rounded-2xl">
    <div class="rounded-lg overflow-clip border">
        <table class="w-full">
            <thead>
            <tr class="bg-background">
                <th class="p-3 border-r">Nom</th>
                <th class="p-3 border-r">Espèce</th>
                <th class="p-3 border-r">Genre</th>
                <th class="p-3 border-r"> Statut</th>
                <th class="p-3 border-r">Fiche</th>
                <th class="p-3 rounded-l-lg">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($animals as $key => $animal)
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
                    <x-table.table-data is-last="true">
                        <x-svg.pen :animal-id="$animal->id"/>
                        <x-svg.delete :animal-id="$animal->id"
                                      wire:click="deleteAnimal({{ $animal->id }})"
                                      wire:confirm="Êtes-vous sûr de vouloir supprimer {{ $animal->name }} ?"/>
                    </x-table.table-data>
                </tr>

            @empty
                <tr class="rounded">
                    <td class="bg-white p-3" colspan="6">
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
        {{ $animals->links('vendor.pagination.livewire-tailwind') }}
    </div>
</div>
