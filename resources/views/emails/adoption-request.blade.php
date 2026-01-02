<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouvelle demande d’adoption</title>
</head>
<body>
<div>

    <h2>Nouvelle demande d’adoption</h2>

    <p>
        Une nouvelle demande d’adoption a été envoyée.
    </p>

    <ul>
        <li><strong>Animal :</strong> {{ $request->animal->name }}</li>
        <li><strong>Nom :</strong> {{ $request->name }}</li>
        <li><strong>Email :</strong> {{ $request->email }}</li>
    </ul>

    <p>
        <a href="{{ route('admin.dashboard') }}">
            Voir dans le dashboard
        </a>
    </p>

    <p>
        {{ config('app.name') }}
    </p>

</div>
</body>
</html>
