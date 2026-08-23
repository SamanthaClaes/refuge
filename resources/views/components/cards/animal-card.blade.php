@php use Carbon\Carbon @endphp
@props([
    'animal',
    'name',
    'sex',
    'age',
    'status',
    'id',
    'avatar',
    'statusColor',
    'breed',
    'animalType',
])

<div class="col-span-1 sm:col-span-1 md:col-span-4 lg:col-span-4">
    @if (!in_array($status, ['en attente', 'en soins']))
        <a href="{{ route('animals.show', ['animal' => $id]) }}" class="block">
            @endif
            <p>{{ $animal->getAvatarUrl() }}</p>
            <div class="bg-element h-auto rounded-xl p-5 w-full transition-transform duration-400 hover:scale-105">
                <div class="pl-2 pt-2 pr-2 pb-6 relative ">

                    <img
                        src="{{ $animal->getAvatarUrl() }}"
                        alt="{{ $name }}"
                        class="rounded-t-lg w-full h-64 object-cover reveal-on-scroll"
                    >
                        <div>
                    <div
                        class="reveal-on-scroll absolute top-4 right-4 text-white font-text rounded-sm p-1 text-sm sm:text-base {{$statusColor}}">
                        {{ $status }}
                    </div>
                    <p class="font-title uppercase bg-background text-text text-center text-lg rounded-b-lg p-2">
                        {{ $name }}
                    </p>
                        </div>
                </div>
                <div class="flex flex-col flex-wrap justify-start items-start gap-2 pb-6 pl-2">
                    <p class="font-text text-text text-base">
                        Sexe : {{ $sex }}
                    </p>

                    <p class="font-text text-text text-base ">
                        Age : {{ $age }}
                    </p>
                    <p class="font-text text-text text-base">
                        Espèce : {{ $animal->animalType->name }} {{ $breed->name }}
                    </p>

                </div>
                <div class="h-12 flex items-center justify-center">
                    @if ($status === 'en soins')
                        <p class="text-center text-sm text-text px-2 bg-background p-1 rounded-lg">
                            <strong>{{ $name }}</strong> est actuellement en soins.
                            Si vous souhaitez l'adopter, n'hésitez pas à nous <a
                                href="{{  route('animals.show', $animal) }}#requestForm" class="font-medium underline">contacter.</a>
                        </p>
                    @elseif ($status === 'en attente')
                        <p class="text-center text-sm text-text px-2  bg-background p-1 rounded-lg">
                            Une demande d'adoption est déjà en cours pour <strong>{{ $name }}</strong>.
                        </p>
                    @else
                        <div class="w-full flex justify-center rounded-lg h-12 items-center bg-cta hover:bg-hover">
            <span class="font-text text-white text-lg sm:text-xl">
                Adopter {{ $name }}
            </span>
                        </div>
                    @endif
                </div>
            </div>
        </a>
</div>
