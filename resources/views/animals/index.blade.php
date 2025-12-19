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
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-12 gap-4 lg:ml-40 mb-10">
            <div class="col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
                <label class="pl-1" for="breed">{{ __('animals.breed') }}</label>
                <select name="breed" id="breed" class="bg-element rounded-lg p-3 w-full mt-1">
                    <option value="">{{ __('animals.select_breed') }}</option>
                    <option value="bergerAllemand">{{ __('animals.german Shepherd') }}</option>
                    <option value="chihuahua">{{ __('animals.chihuahua') }}</option>
                    <option value="caniche">{{ __('animals.poodle') }}</option>
                    <option value="persan">{{ __('animals.persian') }}</option>
                    <option value="british">{{ __('animals.british shorthair') }}</option>
                    <option value="calopsitte">{{ __('animals.cockatiel') }}</option>
                    <option value="lapinNain">{{ __('animals.dwarf rabbit') }}</option>
                </select>
            </div>
            <div class="col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
                <label class="pl-1" for="specie">{{ __('animals.select_specie') }}</label>
                <select name="specie" id="specie" class="bg-element  rounded-lg p-3 w-full  mt-1">
                    <option value=""> {{ __('animals.select_specie') }}</option>
                    <option value="dog">{{ __('animals.dog') }}</option>
                    <option value="cat">{{ __('animals.cat') }}</option>
                    <option value="birds">{{ __('animals.bird') }}</option>
                    <option value="bunny">{{ __('animals.rabbit') }}</option>
                    <option value="rat">{{ __('animals.rat') }}</option>
                </select>
            </div>
            <div class="col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
                <label class="pl-1" for="age">{{ __('animals.age') }}</label>
                <select name="age" id="age" class="bg-element  rounded-lg p-3 w-full  mt-1">
                    <option value="">{{ __('animals.select_age') }}</option>
                    <option value="1">1 {{__('animals.months')}}</option>
                    <option value="2">2 {{__('animals.months')}}</option>
                    <option value="3">3 {{__('animals.months')}}</option>
                    <option value="4">4 {{__('animals.months')}}</option>
                    <option value="5">5 {{__('animals.months')}}</option>
                </select>
            </div>
            <div class="col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
                <label class="pl-1" for="pelage">{{ __('animals.coat') }}</label>

                <select name="pelage" id="pelage" class="bg-element rounded-lg p-3 w-full  mt-1">
                    <option value="">{{ __('animals.select_coat') }}</option>
                    <option value="bringe">{{ __('animals.brindle') }}</option>
                    <option value="EcailleDeTortue">{{__('animals.Tortoiseshell')}}</option>
                    <option value="bleuCobalt">{{__('animals.Cobalt blue')}}</option>
                    <option value="rex">{{ __('animals.Rex') }}</option>
                    <option value="dumboRex">{{ __('animals.Dumbo Rex') }}</option>
                </select>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-6 lg:ml-40 lg:mr-40 lg:mb-40 pb-3">
            @foreach($animals as $animal)
                <x-cards.animal-card
                    :name="$animal->name"
                    :sex="$animal->gender ? __('animals.male') : __('animals.female')"
                    :age="$animal->age->format('d/m/Y')"
                    :status="$animal->status_label"
                    :id="$animal->id"
                    :avatar="$animal->avatar_path"
                />
            @endforeach
        </div>

    </section>
    <x-footer/>
</x-layout.guest>
