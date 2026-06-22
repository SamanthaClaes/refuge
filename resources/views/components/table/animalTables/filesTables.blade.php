<div class="p-4 bg-element rounded-2xl overflow-x-auto">
    <table class="min-w-full border">
        <thead>
        <tr class="bg-gray-50 border-b">
            <th class="border-r">Nom</th>
            <th class="border-r">Espèce</th>
            <th class="border-r">Genre</th>
            <th class="border-r">Statut</th>
            <th class="border-r">Créer par</th>
            <th class="border-r">Actions</th>
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
                        <button class="bg-cta p-2 h-10 rounded-xl text-white hover:bg-hover cursor-pointer" wire:click="validateAnimal({{ $animal->id }})">Valider</button>
                    @endif
                    <button class="bg-cta p-2 h-10 rounded-xl text-white hover:bg-hover cursor-pointer" wire:click="deleteAnimal({{ $animal->id }})">Refuser la fiche</button>
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
<div class="mt-6 mb-12 flex justify-center">
    <div class="bg-element rounded-xl px-4 py-3 shadow-sm">
        {{ $this->pendingAnimals->links('vendor.pagination.livewire-tailwind') }}
    </div>
</div>
