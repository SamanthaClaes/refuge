<x-layout.guest title=" Fiche de {{$animal->name}}">
    <x-header.header/>
    <main>
        <section>
            <h1 class="sr-only">Fiche détaillée de l'animal</h1>
            <div class="grid grid-cols-12 gap-4 mx-4 md:mx-8 mt-8">
                <div class="col-span-12 md:col-span-6">
                    <img
                        src=src="{{ $animal->avatar_path ? Storage::url($animal->avatar_path) : '' }}"
                        alt="{{ $animal->name }}"
                        class="rounded-lg w-full h-90 object-cover reveal-on-scroll"
                    >
                </div>
                <div class="bg-element col-span-12 md:col-span-6 rounded-2xl">
                    <p class="font-title text-text uppercase text-4xl md:text-6xl text-center pb-4 md:pb-8 pt-4 md:pt-8">{{$animal->name}}</p>
                    <div class="flex flex-col md:flex-row justify-around items-center gap-4 md:gap-0">
                        <p class="font-title text-text uppercase text-xl md:text-2xl text-center pb-4 md:pb-8">{{$animal->gender ? __('animals.male') : __('animals.female')}}</p>
                        <p class="font-title text-text uppercase text-xl md:text-2xl text-center pb-4 md:pb-8">{{$animal->vaccine ? 'vacciné(e)' : 'pas vacciné(e)' }}</p>
                        <p class="font-title text-text uppercase text-xl md:text-2xl text-center pb-4 md:pb-8">{{$animal->age->format('d/m/Y')}}</p>
                    </div>
                    <p class="font-text text-text text-lg md:text-xl/10 text-center pb-4 md:pb-8 max-w-2xl mx-auto px-4">
                        {{$animal->description}}
                    </p>
                </div>
                @foreach($demoAvatars as $avatar)
                    <div class="col-span-6 md:col-span-2">
                        <img
                            src="{{ asset('avatars/demo/' . $avatar) }}"
                            alt="{{ $animal->name }}"
                            class="w-full h-65 object-cover rounded-xl transition-transform duration-300 hover:scale-105"
                        >
                        @endforeach
                <livewire:pages.adoption-request :animal-id="$animal->id"/>
            </div>


        </section>
    </main>
    <x-footer/>
</x-layout.guest>
