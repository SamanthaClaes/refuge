<x-layout.guest title="Refuge des pattes heureuses">
   <x-header.header/>
<main>
    <p class="text-p text-center mt-16 mb-5 font-bold font-text"><small>{{ __('welcome.subtitle') }}</small></p>
    <h1 class=" mx-auto text-xl text-center md:text-6xl text-text font-title md:w-2xl md:mx-auto uppercase">{{ __('welcome.title') }}</h1>
    <div class="flex justify-center">
        <img  src="{{ asset('img/empreintes.svg') }}" alt="empreinte de pattes avec une photo des animaux">
    </div>
    <h2 class="text-center text-xl md:text-3xl text-text font-title uppercase mb-4">{{ __('welcome.lastArrived') }}</h2>
    <p class="mx-auto text-center font-text text-text mb-10">{{ __('welcome.arrivedDescription') }}</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-6 px-4 sm:px-8 lg:ml-40 lg:mr-40 lg:mb-15 lg:pb-5 pb-20 ">
        @foreach($animals->take(3) as $animal)
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
    <div class="bg-cta flex justify-center items-center rounded-xl p-4 mx-auto max-w-md mb-40 hover:bg-hover hover:scale-105 transition-transform duration-300">
        <a href="/animals" class="text-white font-text text-lg">{{ __('welcome.allAnimals') }}</a>
    </div>
    <h2 class="text-xl text-center font-title md:text-3xl text-text uppercase">{{ __('welcome.formTitle') }}</h2>
    <p class="text-center text-text font-text px-6 mt-4 md:w-3xl md:mx-auto mb-8">{{ __('welcome.formDescription') }}
    </p>
    <livewire:pages.contact-form />
    @if( session('success'))
        <div
            class="max-w-4xl mx-auto p-4 mb-4 text-green-700 bg-green-100 border border-green-200 rounded"
            wire:poll.5s="$refresh"
        >
            {{ session('success') }}
        </div>
    @endif
</main>
<x-footer/>
</x-layout.guest>
