<dialog
    wire:ignore.self
    x-on:open-edit-profile-modal.window="$el.showModal()"
    x-on:profile-updated.window="$el.close()"
    x-cloak
>
    <x-partials.modal>

        <x-slot:title>
            <div class="flex justify-between items-center w-full">
                <span>Modifier mes informations</span>

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

            <form wire:submit.prevent="updateData" class="space-y-5">

                <div>
                    <label>Nom</label>

                    <input
                        type="text"
                        wire:model="name"
                        class="mt-2 w-full rounded-xl bg-element p-3"
                    >
                </div>

                <div>
                    <label>Email</label>

                    <input
                        type="email"
                        wire:model="email"
                        class="mt-2 w-full rounded-xl bg-element p-3"
                    >
                </div>

                <div>
                    <label>Téléphone</label>

                    <input
                        type="text"
                        wire:model="phone"
                        class="mt-2 w-full rounded-xl bg-element p-3"
                    >
                </div>

                <div class="grid grid-cols-2 gap-4 mt-6">

                    <button
                        type="button"
                        @click="$el.closest('dialog').close()"
                        class="font-bold bg-red-200 rounded-xl p-3 hover:bg-red-300 cursor-pointer"
                    >
                        Annuler
                    </button>

                    <button
                        type="submit"
                        class="font-bold bg-green-100 rounded-xl p-3 hover:bg-green-200 cursor-pointer"
                    >
                        Enregistrer
                    </button>

                </div>

            </form>

        </x-slot:body>

    </x-partials.modal>
</dialog>
