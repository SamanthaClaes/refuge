@php use Carbon\Carbon; @endphp
<x-layout.guest title="Liste des animaux">
    <x-header.header/>
    <section class="relative w-full h-[60vh] overflow-hidden">
        <img src="{{ asset('img/animals/chien.jpg') }}"
             alt=""
             class="absolute inset-0 w-full h-full object-cover animate-fadeZoom">

        <div class="absolute inset-0 bg-black/60"></div>

        <h2 class="absolute inset-0 flex items-center justify-center
               text-white text-3xl font-bold font-title uppercase z-10">
            {{ __('animals.title') }}
        </h2>
    </section>

    <section>
        <h2 class="font-title uppercase text-3xl text-text pt-20 mb-4 ml-40">{{ __('animals.subtitle') }}</h2>

      <livewire:pages.animal-filters />


    </section>
    <x-footer/>
</x-layout.guest>
