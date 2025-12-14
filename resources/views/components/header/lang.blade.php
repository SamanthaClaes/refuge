<header class="relative z-50 w-full">
    <nav class="flex items-center justify-between flex-wrap bg-nav p-5">
        <div class="flex items-center flex-shrink-0 mr-6">
        </div>

        <input type="checkbox" id="menu-toggle" class="peer hidden">
        <label for="menu-toggle"
               class="md:hidden flex items-center px-3 py-2 border rounded text-text-brown cursor-pointer">
            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
            </svg>
        </label>

        <div id="nav-menu" class="w-full hidden peer-checked:block md:flex md:items-center md:w-auto">
            <div class="text-sm md:flex-grow flex flex-col md:flex-row md:items-center">
                <a href="http://localhost:8000"
                   class="uppercase font-title block mt-4 md:mt-0 md:mr-4 hover:underline text-text-brown hover:text-cta-orange transition-colors">
                    Accueil
                </a>
                <a href="/animals"
                   class="uppercase font-title block mt-4 md:mt-0 md:mr-4 hover:underline text-text-brown hover:text-cta-orange transition-colors">
                    Nos animaux
                </a>
                <a href="/#contact-form"
                   class="uppercase font-title block mt-4 md:mt-0 md:mr-4 text-sm px-5 py-2 border rounded text-white hover:bg-hover bg-cta border-cta transition-colors">
                    Contact
                </a>
                <div x-data="{ open:false }" class="relative Æmt-4 md:mt-0 md:ml-4">
                    <button @click="open = !open"
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
        </div>
    </nav>
</header>


