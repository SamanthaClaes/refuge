<x-layout.email title="Nouvel animal ajouté">

    <h1 style="color:#4B2E1D;font-size:32px;margin-bottom:24px;">
        Nouvel animal ajouté
    </h1>

    <p style="color:#2D2D2D;">
        Un nouvel animal vient d'être ajouté au refuge.
    </p>

    <p style="color:#2D2D2D;">
        <strong>Nom :</strong> {{ $animal->name }}<br>
        <strong>Espèce :</strong> {{ $animal->animalType?->name }}<br>
        <strong>Race :</strong> {{ $animal->breed?->name }}
    </p>

    <p style="color:#2D2D2D;">
        Merci de vérifier sa fiche dans l'administration.
    </p>

</x-layout.email>
