<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-6 lg:ml-40 lg:mr-20 lg:mb-20 pb-3">

        <div class="col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
            <label class="pl-1" for="specie">{{ __('animals.specie') }}</label>
            <select wire:model.live="specie" id="specie" class="bg-element rounded-lg p-3 w-full mt-1">
                <option value="">{{ __('animals.select_specie') }}</option>
                <option value="dog">{{ __('animals.dog') }}</option>
                <option value="cat">{{ __('animals.cat') }}</option>
                <option value="birds">{{ __('animals.bird') }}</option>
                <option value="bunny">{{ __('animals.rabbit') }}</option>
                <option value="rat">{{ __('animals.rat') }}</option>
            </select>
        </div>

        <div class="col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
            <label class="pl-1" for="breed">{{ __('animals.breed') }}</label>
            <select wire:model.live="breed" id="breed" class="bg-element rounded-lg p-3 w-full mt-1">
                <option value="">{{ __('animals.select_breed') }}</option>
                @foreach($availableBreeds as $b)
                    <option value="{{ $b }}">{{ ucfirst($b) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
            <label class="pl-1" for="age">{{ __('animals.age') }}</label>
            <select wire:model.live="age" id="age" class="bg-element rounded-lg p-3 w-full mt-1">
                <option value="">{{ __('animals.select_age') }}</option>
                @for($i=1; $i<=5; $i++)
                    <option value="{{ $i }}">{{ $i }} {{ __('animals.months') }}</option>
                @endfor
            </select>
        </div>
        <div class="col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
            <label class="pl-1" for="pelage">{{ __('animals.coat') }}</label>
            <select wire:model.live="pelage" id="pelage" class="bg-element rounded-lg p-3 w-full mt-1">
                <option value="">{{ __('animals.select_coat') }}</option>
                <option value="bringe">{{ __('animals.brindle') }}</option>
                <option value="EcailleDeTortue">{{ __('animals.Tortoiseshell') }}</option>
                <option value="bleuCobalt">{{ __('animals.Cobalt blue') }}</option>
                <option value="rex">{{ __('animals.Rex') }}</option>
                <option value="dumboRex">{{ __('animals.Dumbo Rex') }}</option>
            </select>
        </div>
        <div class="relative col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
            <label for="sort" id="sort">Trier</label>
            <select
                    class="flex items-center justify-between w-full p-3 mt-1 bg-element rounded-lg">
                <option value="">Trier</option>
                <option wire:click="sortBy('name','asc')" value="Nom A → Z">Nom A → Z</option>
                <option wire:click="sortBy('name','desc')" value="Nom Z → A">Nom Z → A</option>
                <option wire:click="sortBy('age','asc')" value="Âge croissant">Âge croissant</option>
                <option wire:click="sortBy('age','desc')" value="Âge décroissant">Âge décroissant</option>
            </select>
        </div>

    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-6 lg:ml-40 lg:mr-40 lg:mb-40 pb-3">
        @foreach($animals->where('status', '!=', 'adopté(e)') as $animal)
            <x-cards.animal-card
                :name="$animal->name"
                :sex="$animal->gender ? __('animals.male') : __('animals.female')"
                :age="$animal->age?->format('d/m/Y')"
                :status="$animal->status_label"
                :id="$animal->id"
                :avatar="$animal->avatar_path"
                :status-color="$animal->statusColor"
                :breed="$animal->breed"
            />
        @endforeach
    </div>
</div>
