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
<main class="">
    <h1 class="text-text font-bold text-2xl text-center mt-8 pb-8">Bienvenue Elise</h1>
    <div class="pl-72 pr-12 grid grid-cols-12 gap-4">
        <div class="col-span-3">
            <a href="#">
                <div class="bg-element h-36 rounded-2xl">
                    <div class="flex justify-between pt-6 pr-6">
                        <p class="text-6xl text-text pl-6">2</p>
                        <div class="w-16 h-16 bg-background rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="32" viewBox="0 0 28 32"
                                 fill="none">
                                <path
                                    d="M21 10.6667C21 8.54496 20.2625 6.51012 18.9497 5.00983C17.637 3.50954 15.8565 2.66669 14 2.66669C12.1435 2.66669 10.363 3.50954 9.05025 5.00983C7.7375 6.51012 7 8.54496 7 10.6667C7 20 3.5 22.6667 3.5 22.6667H24.5C24.5 22.6667 21 20 21 10.6667Z"
                                    fill="#4B2E1D"/>
                                <path
                                    d="M16.0183 28C15.8132 28.4041 15.5188 28.7396 15.1646 28.9727C14.8104 29.2059 14.4088 29.3286 14 29.3286C13.5912 29.3286 13.1896 29.2059 12.8354 28.9727C12.4812 28.7396 12.1868 28.4041 11.9817 28"
                                    fill="#4B2E1D"/>
                                <path
                                    d="M16.0183 28C15.8132 28.4041 15.5188 28.7396 15.1646 28.9727C14.8104 29.2059 14.4088 29.3286 14 29.3286C13.5912 29.3286 13.1896 29.2059 12.8354 28.9727C12.4812 28.7396 12.1868 28.4041 11.9817 28M21 10.6667C21 8.54496 20.2625 6.51012 18.9497 5.00983C17.637 3.50954 15.8565 2.66669 14 2.66669C12.1435 2.66669 10.363 3.50954 9.05025 5.00983C7.7375 6.51012 7 8.54496 7 10.6667C7 20 3.5 22.6667 3.5 22.6667H24.5C24.5 22.6667 21 20 21 10.6667Z"
                                    stroke="#4B2E1D" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <div class="pl-6 pt-2 text-text font-medium">
                        Demandes d'adoptions en attente
                    </div>
                </div>
            </a>
        </div>
        <div class="col-span-3">
            <a href="#">
                <div class="bg-element h-36 rounded-2xl">
                    <div class="flex justify-between pt-6 pr-6">
                        <p class="text-6xl text-text pl-6">23</p>
                        <div class="w-16 h-16 bg-background rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="44" height="36" viewBox="0 0 44 36"
                                 fill="none">
                                <path
                                    d="M6 2H38C40.2 2 42 3.8 42 6V30C42 32.2 40.2 34 38 34H6C3.8 34 2 32.2 2 30V6C2 3.8 3.8 2 6 2Z"
                                    fill="#4B2E1D"/>
                                <path d="M42 6L22 20L2 6" fill="#4B2E1D"/>
                                <path
                                    d="M42 6C42 3.8 40.2 2 38 2H6C3.8 2 2 3.8 2 6M42 6V30C42 32.2 40.2 34 38 34H6C3.8 34 2 32.2 2 30V6M42 6L22 20L2 6"
                                    stroke="#FFF5EB" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <div class="pl-6 pt-2 text-text font-medium">
                        Messages non-lu
                    </div>
                </div>
            </a>
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
                        <td class="px-4 py-4 border-r-1">Rex</td>
                        <td class="px-4 py-4 border-r-1">Berger Allemand</td>
                        <td class="px-4 py-4 border-r-1">Disponible</td>
                        <td class="px-4 py-4 border-r-1">Validée</td>
                        <td class="px-4 py-4 border-r-1">Modifier</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-4 border-r-1">Piaf</td>
                        <td class="px-4 py-4 border-r-1">Perruche</td>
                        <td class="px-4 py-4 border-r-1">Disponible</td>
                        <td class="px-4 py-4 border-r-1">A faire</td>
                        <td class="px-4 py-4 border-r-1">Modifier</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>
</body>
</html>
