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
                class="text-xl"
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
                <div class="mt-2 p-4 bg-background rounded-lg whitespace-pre-wrap">
                    {{ $selectedMessage }}
                </div>
            </div>

        </div>
    </div>
</dialog>
