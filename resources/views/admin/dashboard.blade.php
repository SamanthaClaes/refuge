<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])

    <title>Dashboard</title>
</head>
<body class="bg-background">
<x-header.side-bar/>
<main>
    <x-header.search-bar/>
    <section>
        <h1 class="text-text font-bold text-2xl text-center mt-8 pb-8">Bienvenue Elise</h1>
    </section>

    <div class="pl-72 pr-12 grid grid-cols-12 gap-4">
        <div class="col-span-3">
                <x-cards.dashboard_card number="2" title="Demandes d'adoptions" svg="bell" route="{{ route('messages') }}" />
        </div>
        <div class="col-span-3">
            <x-cards.dashboard_card number="3" title="Messages non lus" svg="mail" route="{{ route('messages') }}"/>
        </div>
        <div class="col-span-3">
            <x-cards.dashboard_card number="34" title="Bénévoles" svg="user" route="{{ route('planning') }}"/>
        </div>
        <div class="col-span-3">
           <x-cards.dashboard_card number="1250" title="Animaux" svg="animals" route="{{ route('animal') }}"/>
        </div>
        <section class="row-start-2 col-span-12">
            <div class="flex justify-between items-center">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste de nos derniers animaux</h2>
                <a href="" class="bg-cta p-2 h-10 rounded-xl text-white hover:bg-hover">
                    + ajouter un animal
                </a>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <table class="border-1 w-full">
                    <thead>
                    <tr class="bg-gray-50 border-b-1">
                        <th class="border-r-1">Nom</th>
                        <th class="border-r-1">Espèce</th>
                        <th class="border-r-1">Status</th>
                        <th class="border-r-1">Fiche</th>
                        <th class="border-r-1">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="px-4 py-4 border-r-1 border-b-1">Rex</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Berger Allemand</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Disponible</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Validée</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">
                            <x-SVG.pen/>
                        </td>

                    </tr>
                    <tr>
                        <td class="px-4 py-4 border-r-1">Piaf</td>
                        <td class="px-4 py-4 border-r-1">Perruche</td>
                        <td class="px-4 py-4 border-r-1">Disponible</td>
                        <td class="px-4 py-4 border-r-1">A faire</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">
                            <x-SVG.pen/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-8">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste de nos bénévoles</h2>
                <a href="" class="bg-cta p-2 h-10 rounded-xl text-white hover:bg-hover">
                    + ajouter un bénévole
                </a>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <table class="border-1 w-full">
                    <thead>
                    <tr class="bg-gray-50 border-b-1">
                        <th class="border-r-1">Nom</th>
                        <th class="border-r-1">Tâches</th>
                        <th class="border-r-1">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="px-4 py-4 border-r-1 border-b-1">Chloé</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Nettoyer la litière des chats</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">
                            <x-SVG.pen/>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-4 border-r-1">Thomas</td>
                        <td class="px-4 py-4 border-r-1">Promener les chiens</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">
                            <x-SVG.pen/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">Statistiques du mois</h2>
            </div>
        </section>
    </div>
</main>
</body>
</html>
