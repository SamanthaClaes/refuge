<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>animaux</title>
</head>
<body class="bg-background">
<header>
    <x-header.side-bar/>
</header>
<main>
    <div class="pl-72 pr-12 grid grid-cols-12 gap-4">
        <section class="row-start-2 col-span-12">
            <div class="flex justify-between items-center">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste des animaux</h2>
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
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-text">
                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />

                                </svg>
                            </a>
                        </td>

                    </tr>
                    <tr>
                        <td class="px-4 py-4 border-r-1">Newton</td>
                        <td class="px-4 py-4 border-r-1">Golden Retriever</td>
                        <td class="px-4 py-4 border-r-1">Disponible</td>
                        <td class="px-4 py-4 border-r-1">Validée</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-text">
                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>
</body>
</html>
