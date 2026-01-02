@props([
    'name',
    'sex',
    'age',
    'id',
    'avatar' => null,
    'status',
    'statusColor',
    'breed',
])

<div class="col-span-1 sm:col-span-1 md:col-span-4 lg:col-span-4">
    <div class="bg-element h-auto rounded-xl p-3 w-full transition-transform duration-400 hover:scale-105 ">
        <div class="pl-2 pt-2 pr-2 pb-6 relative ">
            @if($animal->avatar_path)
                <p class="text-green-600 text-xs">
                    AVATAR: {{ $animal->avatar_path }}
                </p>
            @else
                <p class="text-red-600 text-xs">
                    AVATAR ABSENT
                </p>
            @endif

            <div
                class="reveal-on-scroll absolute top-4 right-4 text-white font-text rounded-sm p-1 text-sm sm:text-base {{$statusColor}}">
                {{ $status }}
            </div>


        </div>
        <p class="font-title uppercase text-text text-2xl sm:text-3xl pb-6 pl-2">{{ $name }}</p>
        <div class="flex flex-col flex-wrap justify-start items-start gap-2 pb-6 pl-2">
            <p class=" font-text text-text text-base sm:text-lg">Sexe : {{ $sex }}</p>
            <p class="font-text text-text text-base sm:text-lg">Date de naissance : {{ $age }}</p>
            <p class="font-text text-text text-base sm:text-lg">Race : {{ $breed }}</p>
        </div>
        <div
            class="flex justify-center rounded-lg h-12 items-center
           {{ $status === 'en attente'
                ? 'bg-gray-400 cursor-not-allowed'
                : 'bg-cta hover:bg-hover' }}"
        >
            @if ($status === 'en attente')
                <span class="font-text text-white text-lg sm:text-xl opacity-70">
            Adoption en cours
        </span>
            @else
                <a
                    href="{{ route('animals.show', ['animal' => $id]) }}"
                    class="font-text text-white text-lg sm:text-xl"
                >
                    Adopter {{ $name }}
                </a>
            @endif
        </div>

    </div>
</div>
