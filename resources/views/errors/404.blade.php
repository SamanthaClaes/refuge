<x-layout.guest title="Page introuvable">
    <main class="min-h-screen flex flex-col items-center justify-center px-4">

        <img
            src="{{ asset('img/catSearching.gif') }}"
            alt="Chat qui ne trouve pas ce qu'il cherche"
            class="w-80 rounded-xl mb-6"
        >

        <h1 class="font-title text-5xl text-text mb-4">
            404
        </h1>

        <p class="text-xl text-text mb-6 text-center">
            Oups ! La page que vous recherchez est introuvable.
        </p>

        <a
            href="{{ route('admin.dashboard') }}"
            class="bg-cta text-white px-6 py-3 rounded-lg hover:bg-hover"
        >
            Retour à l'accueil
        </a>

    </main>
</x-layout.guest>
