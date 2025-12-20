@props([
    'name',
    'sex',
    'age',
    'id',
    'avatar' => null,
    'status',
    'statusColor',
])

<div class="col-span-1 sm:col-span-1 md:col-span-4 lg:col-span-4">
    <div class="bg-element h-auto rounded-xl p-3 w-full transition-transform duration-400 hover:scale-105 ">
        <div class="pl-2 pt-2 pr-2 pb-6 relative ">
            <img
                src="{{ $avatar ? asset('storage/avatars/original/' . basename($avatar)) : '' }}"
                alt="{{ $name }}"
                class="rounded-lg w-full h-64 object-cover reveal-on-scroll"
            >
            <div
                class="reveal-on-scroll absolute top-4 right-4 text-white font-text rounded-sm p-1 text-sm sm:text-base {{$statusColor}}">
                {{ $status }}
            </div>


        </div>
        <p class="font-title uppercase text-text text-2xl sm:text-3xl pb-6 pl-2">{{ $name }}</p>
        <div class="flex flex-col sm:flex-row flex-wrap justify-start items-start gap-2 pb-6 pl-2">
            <p class=" font-text text-text text-base sm:text-lg">Sexe : {{ $sex }}</p>
            <p class="font-text text-text text-base sm:text-lg">Date de naissance : {{ $age }}</p>
        </div>
        <div class="bg-cta flex justify-center rounded-lg h-12 items-center hover:bg-hover">
            <a href="{{ route('animals.show', ['animal' => $id]) }}" class="font-text text-white text-lg sm:text-xl">
                Adopter {{ $name }}
            </a>
        </div>
    </div>
</div>
