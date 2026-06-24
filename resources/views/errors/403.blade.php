<x-layout.guest title="Accès refusé">
    <main class="min-h-screen flex flex-col items-center justify-center px-4">

        <img
            src="{{ asset('img/catNo.gif') }}"
            alt="Chien qui garde l'entrée"
            class="w-80 rounded-xl mb-6"
        >

        <h1 class="font-title text-5xl text-text mb-4">
            403
        </h1>

        <p class="text-xl text-text mb-6 text-center">
            Oups ! Vous n'avez pas l'autorisation d'accéder à cette page.
        </p>

        <a
            href="{{ route('admin.dashboard') }}"
            class="bg-cta text-white px-6 py-3 rounded-lg hover:bg-hover"
        >
            Retour à l'accueil
        </a>

    </main>
</x-layout.guest>
