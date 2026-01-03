<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport Animaux</title>
</head>
<body>

<h1>Rapport Annuel - Gestion des Animaux</h1>

<p>
    <strong>Date du rapport :</strong>
    {{ now()->format('d/m/Y') }}
</p>

<hr>

<h2>Informations générales</h2>

<p>
    <strong>Organisation :</strong> Refuge pour animaux<br>
    <strong>Lieu :</strong> Bruxelles, Belgique<br>
    <strong>Période :</strong> Année {{ now()->year }}
</p>

<hr>

@php
    $totalArrived = array_sum(array_column($data, 'arrived'));
    $totalAdopted = array_sum(array_column($data, 'adopted'));
    $totalRemaining = array_sum(array_column($data, 'remaining'));
@endphp

<h2>Résumé</h2>

<ul>
    <li><strong>Animaux arrivés :</strong> {{ $totalArrived }}</li>
    <li><strong>Animaux adoptés :</strong> {{ $totalAdopted }}</li>
    <li><strong>Animaux restants :</strong> {{ $totalRemaining }}</li>
</ul>

<hr>

<h2>Détails mensuels</h2>

<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Mois</th>
        <th>Arrivés</th>
        <th>Adoptés</th>
        <th>Restants</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item['month'] }}</td>
            <td align="center">{{ $item['arrived'] }}</td>
            <td align="center">{{ $item['adopted'] }}</td>
            <td align="center">{{ $item['remaining'] }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td><strong>TOTAL</strong></td>
        <td align="center"><strong>{{ $totalArrived }}</strong></td>
        <td align="center"><strong>{{ $totalAdopted }}</strong></td>
        <td align="center"><strong>{{ $totalRemaining }}</strong></td>
    </tr>
    </tfoot>
</table>

<hr>

<p>
    Merci pour votre attention.<br>
    &copy; {{ now()->year }} – Refuge pour animaux
</p>

</body>
</html>
