@props([
    'user'
])

<section class="bg-element rounded-3xl p-8 shadow-md">

    <h2 class="font-title text-3xl text-text uppercase mb-8">
        Informations personnelles
    </h2>

    <div>

        <div
            class="grid md:grid-cols-3 justify-center items-center text-center gap-6 bg-background p-3 rounded-lg">

            <div>
                <p class="font-text font-bold ">Nom</p>
                <span> {{ $user->name }}</span>
            </div>

            <div>
                <p class="font-text font-bold">Email</p>
                <span> {{ $user->email }}</span>
            </div>

            <div>
                <p class="font-text font-bold">Téléphone</p>
                <span> {{ $user->phone }} </span>
            </div>

        </div>

        <div class="flex justify-center mt-8">

            <button
                type="button"
                wire:click="openEditProfileModal"
                class="bg-cta hover:bg-hover text-white rounded-xl px-8 py-3 transition cursor-pointer"
            >
                Modifier mes informations
            </button>

        </div>

    </div>

</section>
