@if ($paginator->hasPages())
    <nav class="flex items-center justify-center gap-4">

        {{-- Précédent --}}
        <button
            wire:click="previousPage"
            @disabled($paginator->onFirstPage())
            class="px-4 py-2 rounded-lg
                {{ $paginator->onFirstPage()
                    ? 'bg-nav text-text cursor-not-allowed'
                    : 'bg-element hover:bg-hover' }}"
        >
            ←
        </button>

        {{-- Info --}}
        <span class="text-sm text-text">
            Page {{ $paginator->currentPage() }}/{{ $paginator->lastPage() }}
        </span>

        {{-- Suivant --}}
        <button
            wire:click="nextPage"
            @disabled(! $paginator->hasMorePages())
            class="px-4 py-2 rounded-lg
                {{ ! $paginator->hasMorePages()
                    ? 'bg-nav text-text cursor-not-allowed'
                    : 'bg-element hover:bg-hover' }}"
        >
            →
        </button>

    </nav>
@endif
