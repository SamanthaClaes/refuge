
<div>
    <div wire:click="open" class="relative Æmt-4 md:mt-0 md:ml-4">
        <button wire:click="open = !open"
                class="flex items-center px-3 py-2 border rounded text-text hover:bg-hover">
            <img src="{{ asset('svg/flags/flag-' . (session('locale') ?? 'fr') . '.svg') }}"
                 alt="langue" class="w-6 h-4 mr-2">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                      clip-rule="evenodd"/>
            </svg>
        </button>

        <ul x-show="open" @click.outside="open = false" class="absolute right-0 bg-white shadow-md rounded-md mt-1 w-36 text-left z-50">
            <li>
                <a href="{{ url('/lang/fr') }}"
                   class="flex items-center px-3 py-2 hover:bg-gray-100 {{ session('locale') === 'fr' ? 'bg-gray-200' : '' }}">
                    <img src="{{ asset('svg/flags/flag-fr.svg') }}" class="w-6 h-4 mr-2"
                         alt="drapeau français">
                    Français
                </a>
            </li>
            <li>
                <a href="{{ url('/lang/nl') }}"
                   class="flex items-center px-3 py-2 hover:bg-gray-100 {{ session('locale') === 'nl' ? 'bg-gray-200' : '' }}">
                    <img src="{{ asset('svg/flags/flag-nl.svg') }}" class="w-6 h-4 mr-2"
                         alt="drapeau des pays-bas">
                    Nederlands
                </a>
            </li>
            <li>
                <a href="{{ url('/lang/en') }}"
                   class="flex items-center px-3 py-2 hover:bg-gray-100 {{ session('locale') === 'en' ? 'bg-gray-200' : '' }}">
                    <img src="{{ asset('svg/flags/flag-en.svg') }}" class="w-6 h-4 mr-2"
                         alt="drapeau Grande-Bretagne">
                    English
                </a>
            </li>
        </ul>

    </div>
</div>
