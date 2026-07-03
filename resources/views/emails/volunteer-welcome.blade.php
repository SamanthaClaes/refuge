```blade
<x-layout.email title="Bienvenue au Refuge Les Pattes Heureuses">

    <h1 style="margin:0 0 24px;color:#4B2E1D;font-size:30px;font-weight:bold;">
        Bienvenue {{ $user->name }} !
    </h1>

    <p style="margin:0 0 20px;color:#2D2D2D;font-size:16px;line-height:1.7;">
        Nous sommes heureux de vous accueillir au sein du
        <strong>Refuge Les Pattes Heureuses</strong>.
    </p>

    <p style="margin:0 0 20px;color:#2D2D2D;font-size:16px;line-height:1.7;">
        Un compte bénévole vient d'être créé à votre nom.
        Avant de pouvoir accéder à votre espace personnel, vous devez définir votre mot de passe.
    </p>

    <p style="margin:0 0 30px;color:#2D2D2D;font-size:16px;line-height:1.7;">
        Cliquez sur le bouton ci-dessous pour choisir votre mot de passe :
    </p>

    <a
        href="{{ $resetUrl }}"
        style="display:inline-block;padding:12px 24px;background:#4B2E1D;color:#FFFFFF;text-decoration:none;border-radius:8px;font-weight:bold;"
    >
        Définir mon mot de passe
    </a>

    <p style="margin:30px 0 20px;color:#2D2D2D;font-size:15px;line-height:1.7;">
        Ce lien est personnel et valable pour une durée limitée.
    </p>

    <p style="margin:0;color:#2D2D2D;font-size:16px;line-height:1.7;">
        À très bientôt,<br>
        <strong>L'équipe du Refuge Les Pattes Heureuses</strong>
    </p>

</x-layout.email>
```
