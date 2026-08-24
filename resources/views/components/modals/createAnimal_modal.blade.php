@props([
    'avatar' => null,
])

<dialog
    wire:ignore.self
    x-data
    x-on:open-create-modal.window="
        $el.showModal();
        document.body.style.overflow = 'hidden';
    "
    x-on:animal-created.window="
        $el.close();
        document.body.style.overflow = '';
    "
    x-on:close="
        document.body.style.overflow = '';
    "
    x-cloak
>
    <x-partials.modal>

        <div class="flex justify-between items-center w-full">
            <x-slot:title>
                Ajouter une fiche animale

                <button
                    type="button"
                    @click="$el.closest('dialog').close()"
                    class="text-2xl font-bold cursor-pointer hover:text-red-500 transition-colors"
                    aria-label="Fermer"
                >
                    ✕
                </button>
            </x-slot:title>
        </div>

        <x-slot:body>

            <form
                wire:submit.prevent="storeAnimal"
                class="space-y-5 text-text"
                enctype="multipart/form-data"
            >
                <div>
                    @if($avatar)
                        <img
                            class="mt-4 h-40 w-40 object-cover rounded-2xl"
                            src="{{ $avatar->temporaryUrl() }}"
                            alt="Prévisualisation"
                        >
                    @endif

                    <label for="avatar" class="font-semibold text-text">
                        Choisir l’avatar
                    </label>

                    <input
                        type="file"
                        wire:key="avatar-input"
                        wire:model="avatar"
                        class="mt-2 w-full bg-element rounded-xl px-3 py-2"
                        id="avatar"
                        name="avatar"
                        accept=".jpg,.jpeg,.webp"
                    >

                    @error('avatar')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div>
                    <label for="avatar_path" class="font-semibold text-text">
                        Choisir les avatars
                    </label>

                    <input
                        type="file"
                        multiple
                        wire:key="avatar_path-input"
                        wire:model="avatar_path"
                        class="mt-2 w-full bg-element rounded-xl px-3 py-2"
                        id="avatar_path"
                        name="avatar_path[]"
                    >

                    @error('avatar_path')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div>
                    <label for="name" class="font-semibold text-text">
                        Nom
                        <abbr title="Requis" class="text-red-500 no-underline">*</abbr>
                    </label>

                    <input
                        wire:model="name"
                        type="text"
                        id="name"
                        name="name"
                        required
                        class="mt-2 w-full bg-element rounded-xl px-3 py-2 font-text focus:ring-2 focus:ring-cta focus:border-transparent"
                    >

                    @error('name')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label for="animal_type_id" class="font-semibold text-text">
                            Espèce
                            <abbr title="Requis" class="text-red-500 no-underline">*</abbr>
                        </label>

                        <select
                            wire:model.live="animal_type_id"
                            id="animal_type_id"
                            required
                            class="mt-2 w-full bg-element rounded-xl px-3 py-2 font-text"
                        >
                            <option value="">Choisir une espèce</option>

                            @foreach($this->animalTypes as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('animal_type_id')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="flex-1">
                        <label for="breed_id" class="font-semibold text-text">
                            Race
                            <abbr title="Requis" class="text-red-500 no-underline">*</abbr>
                        </label>

                        <select
                            wire:model="breed_id"
                            id="breed_id"
                            required
                            class="mt-2 w-full bg-element rounded-xl px-3 py-2 font-text"
                        >
                            <option value="">
                                Choisir une race
                            </option>

                            @foreach($this->breeds as $breed)
                                <option value="{{ $breed->id }}">
                                    {{ $breed->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('breed_id')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>
                    <div class="flex-1">
                        <label for="gender" class="font-semibold text-text">
                            Genre
                            <abbr title="Requis" class="text-red-500 no-underline">*</abbr>
                        </label>

                        <select
                            class="mt-2 w-full bg-element rounded-xl px-3 py-2 font-text"
                            wire:model="gender"
                            required
                            id="gender"
                        >
                            <option value="">Choisir un genre</option>
                            <option value="1">Mâle</option>
                            <option value="0">Femelle</option>
                        </select>

                        @error('gender')
                        <p class="mt-1 text-sm text-red-600">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                </div>
                <div>
                    <label for="age" class="font-semibold text-text">
                        Date de naissance
                    </label>

                    <input
                        wire:model="age"
                        type="date"
                        id="age"
                        name="age"
                        class="mt-2 w-full bg-element rounded-xl px-3 py-2 font-text"
                    >

                    @error('age')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div>
                    <label for="status" class="font-semibold text-text">
                        Statut
                        <abbr title="Requis" class="text-red-500 no-underline">*</abbr>
                    </label>

                    <select
                        wire:model="status"
                        required
                        id="status"
                        class="mt-2 w-full bg-element rounded-xl px-3 py-2 font-text"
                    >
                        <option value="">Choisir un statut</option>
                        <option value="disponible">Disponible</option>
                        <option value="en attente">En attente</option>
                        <option value="en soins">En soins</option>
                        <option value="adopté(e)">Adopté(e)</option>
                    </select>

                    @error('status')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror

                    <div class="mt-4 space-y-3">

                        <label for="adoption_start" class="font-semibold text-text">
                            Date début adoption (optionnelle)
                        </label>

                        <input
                            type="date"
                            wire:model="adoptionStartDate"
                            id="adoption_start"
                            class="mt-2 w-full bg-element rounded-xl px-3 py-2 font-text"
                        >

                        <label for="closed_at">
                            Date clôture adoption
                        </label>

                        <input
                            type="date"
                            wire:model="adoptionClosedAt"
                            id="closed_at"
                            class="mt-2 w-full bg-element rounded-xl px-3 py-2 font-text"
                        >

                    </div>
                </div>
                <div>
                    <label for="vaccine" class="font-semibold text-text">
                        Vaccin
                        <abbr title="Requis" class="text-red-500 no-underline">*</abbr>
                    </label>

                    <select
                        class="mt-2 w-full bg-element rounded-xl px-3 py-2 font-text"
                        wire:model="vaccine"
                        required
                        id="vaccine"
                    >
                        <option value="">Choisir une option</option>
                        <option value="1">Vacciné</option>
                        <option value="0">Pas de vaccin</option>
                    </select>

                    @error('vaccine')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="font-semibold text-text">
                        Description
                    </label>

                    <textarea
                        id="description"
                        class="mt-2 w-full bg-element rounded-xl px-3 py-2 font-text h-32 resize-none focus:ring-2 focus:ring-cta focus:border-transparent"
                        wire:model="description"
                    ></textarea>

                    @error('description')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="mt-6 grid grid-cols-2 gap-4">

                    <button
                        type="button"
                        @click="$el.closest('dialog').close()"
                        class="font-medium bg-red-200 rounded-xl p-3 w-full hover:bg-red-300 cursor-pointer"
                    >
                        Annuler la fiche
                    </button>

                    <span
                        wire:loading
                        wire:target="storeAnimal"
                        class="flex items-center justify-center gap-2"
                    >
                        <svg
                            class="animate-spin h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            ></circle>

                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                            ></path>
                        </svg>

                        Création en cours…
                    </span>

                    <button
                        wire:loading.attr="disabled"
                        wire:target="storeAnimal,avatar,avatar_path"
                        type="submit"
                        class="font-medium bg-green-100 rounded-xl p-3 w-full hover:bg-green-200 cursor-pointer"
                    >
                        Ajouter une fiche animale
                    </button>

                </div>

            </form>
        </x-slot:body>

    </x-partials.modal>
</dialog>
