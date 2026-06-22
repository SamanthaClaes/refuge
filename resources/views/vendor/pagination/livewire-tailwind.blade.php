@if ($paginator->hasPages())
    <nav class="flex items-center justify-center gap-4">

        {{-- Précédent --}}
        <button
            wire:click="previousPage('{{ $paginator->getPageName() }}')"
            @disabled($paginator->onFirstPage())
            class="px-4 py-2 rounded-lg
<<<<<<< Updated upstream
                {{ $paginator->onFirstPage()
                    ? 'bg-nav text-text cursor-not-allowed'
                    : 'bg-element hover:bg-hover' }}"
=======
        {{ $paginator->onFirstPage()
            ? 'bg-nav text-text cursor-not-allowed'
            : 'bg-element hover:bg-hover' }}"
>>>>>>> Stashed changes
        >
            ←
        </button>

        {{-- Info --}}
        <span class="text-sm text-text">
<<<<<<< Updated upstream
            Page {{ $paginator->currentPage() }}/{{ $paginator->lastPage() }}
        </span>
=======
    Page {{ $paginator->currentPage() }}/{{ $paginator->lastPage() }}
</span>
>>>>>>> Stashed changes

        {{-- Suivant --}}
        <button
            wire:click="nextPage('{{ $paginator->getPageName() }}')"
            @disabled(! $paginator->hasMorePages())
            class="px-4 py-2 rounded-lg
<<<<<<< Updated upstream
                {{ ! $paginator->hasMorePages()
                    ? 'bg-nav text-text cursor-not-allowed'
                    : 'bg-element hover:bg-hover' }}"
=======
        {{ ! $paginator->hasMorePages()
            ? 'bg-nav text-text cursor-not-allowed'
            : 'bg-element hover:bg-hover' }}"
>>>>>>> Stashed changes
        >
            →
        </button>
    </nav>
@endif
