<x-layout.guest title="messages">
<h1>Nouvel animal ajouté</h1>

<p>Un nouvel animal vient d’être créé dans le refuge.</p>

<p>
    Nom : {{ $animal->name }}<br>
    Espèce : {{ $animal->specie }}<br>
    Race : {{ $animal->breed }}
</p>

<p>
    Merci de vérifier la fiche dans l’administration.
</p>
</x-layout.guest>
