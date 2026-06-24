<div>
    <x-modals.dialog_modale
        x-on:open-edit-volunteer-modal.window="$el.showModal()"
        x-on:volunteer-edited.window="$el.close()"
    >
        <x-slot:title>
            <div class="flex items-center justify-between w-full text-text font-bold">
                <span>Modifier un bénévole</span>

                <button
                    type="button"
                    onclick="this.closest('dialog').close()"
                    class="text-2xl font-bold cursor-pointer hover:text-red-500 transition-colors"
                    aria-label="Fermer"
                >
                    ×
                </button>
            </div>
        </x-slot:title>
        <x-slot:body>
            <form wire:submit.prevent="editVolunteer" class="space-y-4">

                <div>
                    <label for="name">Nom</label>
                    <input
                        wire:model="name"
                        class="mt-1 w-full bg-background rounded-lg pl-2 font-text"
                        type="text"
                        id="name"
                        name="name"
                    >
                </div>

                <div>
                    <label for="email">Email</label>
                    <input
                        wire:model="email"
                        class="mt-1 w-full bg-background rounded-lg pl-2 font-text"
                        type="email"
                        id="email"
                        name="email"
                    >
                </div>

                <div>
                    <label for="phone">Téléphone</label>
                    <input
                        wire:model="phone"
                        class="mt-1 w-full bg-background rounded-lg pl-2 font-text"
                        type="text"
                        id="phone"
                        name="phone"
                    >
                </div>

                <div class="flex justify-around items-center gap-4 pt-2">

                    <button
                        type="button"
                        onclick="this.closest('dialog').close()"
                        class="text-cta font-bold border-2 border-solid border-cta rounded-lg p-2 w-full hover:bg-gray-100 cursor-pointer"
                    >
                        Annuler
                    </button>

                    <button
                        type="submit"
                        class="text-white font-bold bg-cta rounded-lg p-2 w-full border-2 border-cta hover:bg-hover cursor-pointer"
                    >
                        Enregistrer
                    </button>

                </div>
            </form>
        </x-slot:body>
    </x-modals.dialog_modale>
</div>
