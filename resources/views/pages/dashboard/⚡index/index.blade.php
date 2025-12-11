
<div>
    <x-layout.guest title="DashBoard">
        <x-header.side-bar/>
        <main>
            <x-header.search-bar/>

            <div class="pl-4 md:pl-72 pr-4 md:pr-12 grid grid-cols-1 md:grid-cols-4 gap-4">


                <div>
                    <x-cards.dashboard_card number="2" title="Demandes d'adoptions" svg="bell" route="{{ route('admin.messages') }}" />
                </div>

                <div>
                    <x-cards.dashboard_card number="3" title="Messages non lus" svg="mail" route="{{ route('admin.messages') }}"/>
                </div>

                <div>
                    <x-cards.dashboard_card number="34" title="Bénévoles" svg="user" route="{{ route('admin.planning') }}"/>
                </div>

                <div>
                    <x-cards.dashboard_card number="1250" title="Animaux" svg="animals" route="{{ route('admin.animals') }}"/>
                </div>

            </div>
            <section class="row-start-2 col-span-12 mt-8 px-4 md:pl-72">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                    <h2 class="font-semibold text-text text-xl pb-4 md:pb-0">Liste de nos derniers animaux</h2>
                    <x-cta.add/>
                </div>

                <div class="p-4 bg-element rounded-2xl overflow-x-auto">
                    <table class="min-w-full border-1">
                        <thead>
                        <tr class="bg-gray-50 border-b-1">
                            <th class="border-r-1 px-2 py-2">Nom</th>
                            <th class="border-r-1 px-2 py-2">Espèce</th>
                            <th class="border-r-1 px-2 py-2">Status</th>
                            <th class="border-r-1 px-2 py-2">Fiche</th>
                            <th class="border-r-1 px-2 py-2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="px-2 py-2 border-r-1 border-b-1">Rex</td>
                            <td class="px-2 py-2 border-r-1 border-b-1">Berger Allemand</td>
                            <td class="px-2 py-2 border-r-1 border-b-1">Disponible</td>
                            <td class="px-2 py-2 border-r-1 border-b-1">Validée</td>
                            <td class="px-2 py-2 border-r-1 border-b-1">
                                <x-SVG.pen/>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 border-r-1">Piaf</td>
                            <td class="px-2 py-2 border-r-1">Perruche</td>
                            <td class="px-2 py-2 border-r-1">Disponible</td>
                            <td class="px-2 py-2 border-r-1">A faire</td>
                            <td class="px-2 py-2 border-r-1 border-b-1">
                                <x-SVG.pen/>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mt-8 mb-4">
                    <h2 class="font-semibold text-text text-xl pb-4 md:pb-0">Liste de nos bénévoles</h2>
                    <x-cta.add class="mt-2 md:mt-0"/>
                </div>

                <div class="p-4 bg-element rounded-2xl overflow-x-auto">
                    <table class="min-w-full border-1">
                        <thead>
                        <tr class="bg-gray-50 border-b-1">
                            <th class="border-r-1 px-2 py-2">Nom</th>
                            <th class="border-r-1 px-2 py-2">Tâches</th>
                            <th class="border-r-1 px-2 py-2">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="px-2 py-2 border-r-1 border-b-1">Chloé</td>
                            <td class="px-2 py-2 border-r-1 border-b-1">Nettoyer la litière des chats</td>
                            <td class="px-2 py-2 border-r-1 border-b-1">
                                <x-SVG.pen/>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-2 py-2 border-r-1">Thomas</td>
                            <td class="px-2 py-2 border-r-1">Promener les chiens</td>
                            <td class="px-2 py-2 border-r-1 border-b-1">
                                <x-SVG.pen/>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-8">
                    <h2 class="font-semibold text-text text-xl pb-4">Statistiques du mois</h2>
                    <canvas id="animalsChart" class="w-full h-64"></canvas>
                </div>
            </section>
        </main>
    </x-layout.guest>

</div>
