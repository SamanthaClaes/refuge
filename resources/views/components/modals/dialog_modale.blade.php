@props(['title', 'body'])

<dialog
    {{ $attributes }}
    class="bg-transparent border-none p-0 backdrop:bg-black/40 backdrop:backdrop-blur-xs m-auto"
>
    <div
        class="relative p-6 w-[650px] max-w-[90vw] rounded-lg bg-background shadow-sm max-h-[90vh] overflow-y-auto"
    >
        <div class="flex items-center justify-center pb-4 text-lg">
            {{ $title }}
        </div>

        {{ $body }}
    </div>
</dialog>
