<header class=" relative z-50 w-full">
    <nav class="flex items-center justify-between flex-wrap bg-nav p-5">
        <div class="flex items-center flex-shrink-0 mr-6">
           {{-- <a href="#"><img src="{{ asset('img/Logo.png/') }}" alt="Logo les pattes heureuses" width="20">
            </a>--}}
        </div>
        <input type="checkbox" id="menu-toggle" class="peer hidden">
        <label for="menu-toggle"
               class="md:hidden flex items-center px-3 py-2 border rounded text-text-brown cursor-pointer">
            <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
            </svg>
        </label>
        <div id="nav-menu"
             class="w-full hidden peer-checked:block md:flex md:items-center md:w-auto">

            <div class="text-sm md:flex-grow">
                <a href="http://localhost:8000"
                   class="uppercase font-title block mt-4 md:inline-block hover:underline md:mt-0 text-text-brown hover:text-cta-orange transition-colors mr-4">
                    Accueil
                </a>

                <a href="/animals"
                   class=" uppercase font-title block mt-4 md:inline-block hover:underline md:mt-0 text-text-brown hover:text-cta-orange transition-colors mr-4">
                    Nos animaux
                </a>

                <a href="#"
                   class=" uppercase font-title inline-block text-sm px-5 py-3 leading-none border rounded text-white hover:bg-hover bg-cta border-cta transition-colors mt-4 md:mt-0">
                    Contact
                </a>

            </div>


        </div>
    </nav>
</header>
