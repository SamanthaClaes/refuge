<x-modals.dialog_modale
    x-on:open-create-volunteer-modal.window="$el.showModal()"
    x-on:volunteer-created.window="$el.close()"
>
    <x-slot:title>
        <div class="flex justify-between items-center w-full text-text">
            <h2 class="text-xl font-semibold">
                Ajouter une fiche bénévole
            </h2>

            <button
                type="button"
                onclick="this.closest('dialog').close()"
                class="text-xl cursor-pointer hover:text-red-500"
                aria-label="Fermer"
            >
                ✕
            </button>
        </div>
    </x-slot:title>

    <x-slot:body>
        <form wire:submit.prevent="store" class="space-y-4 text-text">

            <div>
                <label for="name" class="font-semibold">
                    {{ __('modal.name') }}
                </label>

                <input
                    wire:model="name"
                    class="mt-1 w-full bg-element rounded-lg p-2"
                    type="text"
                    id="name"
                    name="name"
                >
            </div>

            <div>
                <label for="email" class="font-semibold">
                    Email
                </label>

                <input
                    wire:model="email"
                    class="mt-1 w-full bg-element rounded-lg p-2"
                    type="email"
                    id="email"
                    name="email"
                >
            </div>

            <div>
                <label for="phone" class="font-semibold">
                    Téléphone
                </label>

                <input
                    wire:model="phone"
                    class="mt-1 w-full bg-element rounded-lg p-2"
                    type="text"
                    id="phone"
                    name="phone"
                >
            </div>

            <div class="mt-4 grid grid-cols-2 gap-3">

                <button
                    type="button"
                    onclick="this.closest('dialog').close()"
                    class="bg-red-200 rounded-lg p-2 hover:bg-red-300 transition cursor-pointer font-medium"
                >
                    {{ __('modal.cancelCreation') }}
                </button>

                <button
                    type="submit"
                    class="bg-green-100  rounded-lg p-2 hover:bg-green-200 transition cursor-pointer font-medium"
                >
                    Ajouter un bénévole
                </button>

            </div>

        </form>
    </x-slot:body>
</x-modals.dialog_modale>
