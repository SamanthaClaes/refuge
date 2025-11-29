<x-layout.guest title="Tous les animaux">
<header>
    <x-header.side-bar/>
</header>
<main>
    <div class="pl-72 pr-12 grid grid-cols-12 gap-4">
        <section class="row-start-2 col-span-12">
            <h1 class="sr-only">Liste de tous les animaux</h1>
            <div class="flex justify-between items-center">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste des animaux</h2>
               <x-cta.add/>
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
                        <td class="px-4 py-4 border-r-1 border-b-1">Newton</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Golden Retriever</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Disponible</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Validée</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">
                            <x-SVG.pen/>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-4 border-r-1 border-b-1">Freddy</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Bouledogue Français</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Disponible</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Validée</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">
                            <x-SVG.pen/>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-4 border-r-1 border-b-1">Archibald</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Siamois</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Disponible</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Validée</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">
                            <x-SVG.pen/>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-4 border-r-1 ">Moka</td>
                        <td class="px-4 py-4 border-r-1">Caniche</td>
                        <td class="px-4 py-4 border-r-1">Disponible</td>
                        <td class="px-4 py-4 border-r-1">Validée</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">
                            <x-SVG.pen/>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-8">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste des animaux en cours d'adoption</h2>
                <x-cta.add/>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <table class="border-1 w-full">
                    <thead>
                    <tr class="bg-gray-50 border-b-1">
                        <th class="border-r-1">Nom</th>
                        <th class="border-r-1">Espèce</th>
                        <th class="border-r-1">Adoption</th>
                        <th class="border-r-1">Fiche</th>
                        <th class="border-r-1">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="px-4 py-4 border-r-1 border-b-1">Garfield</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">British shortair</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">En cours</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Validée</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">
                            <x-SVG.pen/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-8">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste des animaux en soins</h2>
                <x-cta.add/>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <table class="border-1 w-full">
                    <thead>
                    <tr class="bg-gray-50 border-b-1">
                        <th class="border-r-1">Nom</th>
                        <th class="border-r-1">Espèce</th>
                        <th class="border-r-1">Adoption</th>
                        <th class="border-r-1">Fiche</th>
                        <th class="border-r-1">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="px-4 py-4 border-r-1 border-b-1">Billy</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Chihuahua</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">En soins</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Validée</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">
                            <x-SVG.pen/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-8">
                <h2 class="pt-8 font-semibold text-text text-xl pb-4">Liste des animaux adoptés</h2>
                <x-cta.add/>
            </div>
            <div class="p-4 bg-element rounded-2xl">
                <table class="border-1 w-full">
                    <thead>
                    <tr class="bg-gray-50 border-b-1">
                        <th class="border-r-1">Nom</th>
                        <th class="border-r-1">Espèce</th>
                        <th class="border-r-1">Adoption</th>
                        <th class="border-r-1">Fiche</th>
                        <th class="border-r-1">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="px-4 py-4 border-r-1 border-b-1">Cookie</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Européen</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Adoptée</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">Validée</td>
                        <td class="px-4 py-4 border-r-1 border-b-1">
                            <x-SVG.pen/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</main>
</x-layout.guest>
