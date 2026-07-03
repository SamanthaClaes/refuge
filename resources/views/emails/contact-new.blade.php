<x-layout.email title="Nouveau message de contact">

    <h1 style="margin:0 0 24px;color:#4B2E1D;font-size:30px;font-weight:bold;">
        Nouveau message reçu
    </h1>

    <p style="margin:0 0 20px;color:#2D2D2D;font-size:16px;line-height:1.7;">
        Un nouvel utilisateur a envoyé un message via le formulaire de contact du site.
    </p>

    <p style="margin:0 0 30px;color:#2D2D2D;font-size:16px;line-height:1.7;">
        Connectez-vous à l'espace d'administration afin de consulter son message et, si nécessaire, d'y répondre.
    </p>

    <a
        href="{{ route('admin.messages') }}"
        style="display:inline-block;padding:12px 24px;background:#4B2E1D;color:#FFFFFF;text-decoration:none;border-radius:8px;font-weight:bold;"
    >
        Consulter les messages
    </a>

</x-layout.email>
