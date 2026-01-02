<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Bonjour {{ $user->name }},</h1>
<p>
    Bienvenue au refuge !

    Un compte bénévole vient d’être créé pour vous.
    Pour commencer, merci de définir votre mot de passe
    en cliquant sur le lien ci-dessous :

    {{ $resetUrl }}

    Ce lien est personnel et valable pour une durée limitée.

    À très bientôt,
    L’équipe du refuge

</p>
</body>
</html>
