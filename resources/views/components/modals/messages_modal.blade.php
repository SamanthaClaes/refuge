@props([
    'selectedName' => null,
    'selectedEmail' => null,
    'selectedMessage' => null,
])

<dialog
    wire:ignore.self
    x-on:open-message-modal.window="$el.showModal()"
    x-cloak
    class="m-auto rounded-2xl backdrop:bg-black/50"
>
    <div class="p-6 w-[600px] rounded-xl">

        <div class="flex justify-between items-center mb-6 text-text">
            <h2 class="text-xl font-semibold">
                Détails du message
            </h2>

            <button
                type="button"
                onclick="this.closest('dialog').close()"
                class="text-xl cursor-pointer hover:text-red-500"
            >
                ✕
            </button>
        </div>

        <div class="space-y-4 text-text">

            <div>
                <p class="font-semibold">Nom</p>
                <p>{{ $selectedName }}</p>
            </div>

            <div>
                <p class="font-semibold">Email</p>
                <a href="mailto:{{ $selectedEmail }}" class="underline font-bold text-text">{{ $selectedEmail }}</a>
            </div>

            <div>
                <p class="font-semibold">Message</p>
                <div class="mt-2 p-2 bg-background rounded-lg whitespace-pre-wrap wrap-break-word overflow-y-auto max-h-80">
                    {{ $selectedMessage }}
                </div>

        </div>
        <div class="mt-4 grid grid-cols-2 gap-3">

            <a
                href="mailto:{{ $selectedEmail }}"
                class="text-center bg-green-100 rounded-lg p-2 hover:bg-green-200  transition cursor-pointer"
            >
                Répondre au message
            </a>

            <button
                type="button"
                onclick="this.closest('dialog').close()"
                class="bg-red-200 rounded-lg p-2 hover:bg-red-300  transition cursor-pointer"
            >
                Fermer
            </button>

        </div>
    </div>
    </div>
</dialog>
