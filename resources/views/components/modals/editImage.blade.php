@props([
    'user',
    'avatar',
])

<dialog
    wire:ignore.self
    x-on:open-avatar-modal.window="$el.showModal()"
    x-on:avatar-updated.window="$el.close()"
    x-cloak
>
    <x-partials.modal>

        <x-slot:title>
            <div class="flex justify-between items-center w-full">
                <span>Modifier ma photo</span>

                <button
                    type="button"
                    @click="$el.closest('dialog').close()"
                    class="text-2xl font-bold cursor-pointer hover:text-red-500 transition-colors"
                    aria-label="Fermer"
                >
                    ✕
                </button>
            </div>
        </x-slot:title>

        <x-slot:body>

            <form wire:submit.prevent="updateAvatar" class="space-y-6">

                <div class="flex justify-center">

                    <img
                        src="{{ $avatar ? $avatar->temporaryUrl() : $user->getAvatarUrl() }}"
                        alt="Photo de profil"
                        class="w-40 h-40 rounded-full object-cover border-4 border-element"
                    >

                </div>

                <div>

                    <label>Nouvelle photo</label>

                    <input
                        type="file"
                        wire:model="avatar"
                        class="mt-2 block w-full rounded-xl bg-background p-3"
                    >

                    @error('avatar')
                    <p class="text-red-500 mt-2 text-sm">{{ $message }}</p>
                    @enderror

                </div>

                <div class="grid grid-cols-2 gap-4">

                    <button
                        type="button"
                        @click="$el.closest('dialog').close()"
                        class="font-bold bg-red-200 rounded-xl p-3 hover:bg-red-300"
                    >
                        Annuler
                    </button>

                    <button
                        type="submit"
                        class="font-bold bg-green-100 rounded-xl p-3 hover:bg-green-200"
                    >
                        Enregistrer
                    </button>

                </div>

            </form>

        </x-slot:body>

    </x-partials.modal>
</dialog>
