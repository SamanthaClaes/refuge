
<div>
    <x-layout.guest title="Messages">
        <main>
            <x-header.side-bar/>
            <h1 class="pl-72 mt-8 text-2xl uppercase text-text text-center">Liste des messages</h1>
            <div class="pl-72 pr-12 grid grid-cols-12 gap-4">
                <section class="row-start-2 col-span-12">
                    <h2 class="pt-8 font-semibold text-text text-xl pb-4 uppercase">
                        Messages non lus
                    </h2>
                    <div class="p-4 bg-element rounded-2xl">
                        <table class="border-1 w-full">
                            <thead>
                            <tr class="border-b-1">
                                <th class="border-r-1">Nom</th>
                                <th class="border-r-1">Email</th>
                                <th class="border-r-1">Téléphone</th>
                                <th class="border-r-1">Message</th>
                                <th class="border-r-1">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="px-4 py-4 border-r-1 border-b-1">Marie</td>
                                <td class="px-4 py-4 border-r-1 border-b-1">Marie@mail.be</td>
                                <td class="px-4 py-4 border-r-1 border-b-1">0490 12 34 56</td>
                                <td class="px-4 py-4 border-r-1 border-b-1">Bonjour, j’aimerais poser quelques questions au
                                    sujet de Rex
                                </td>
                                <td class="px-4 py-4 border-r-1 border-b-1">
                                    <a href="">
                                        <x-svg.pen/>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-4 border-r-1">Clément</td>
                                <td class="px-4 py-4 border-r-1">Clément@mail.be</td>
                                <td class="px-4 py-4 border-r-1">04 90 90 90 90</td>
                                <td class="px-4 py-4 border-r-1">Bonjour, j’aimerais poser quelques questions du bénévolat</td>
                                <td class="px-4 py-4 border-r-1 border-b-1">
                                    <a href="">
                                        <x-svg.pen/>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <h2 class="pt-8 font-semibold text-text text-xl pb-4 uppercase">Demandes d'adoptions</h2>
                    </div>
                    <div class="p-4 bg-element rounded-2xl">
                        <table class="border-1 w-full">
                            <thead>
                            <tr class="border-b-1">
                                <th class="border-r-1">Nom</th>
                                <th class="border-r-1">Email</th>
                                <th class="border-r-1">Téléphone</th>
                                <th class="border-r-1">Message</th>
                                <th class="border-r-1">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="px-4 py-4 border-r-1 border-b-1">Marie</td>
                                <td class="px-4 py-4 border-r-1 border-b-1">Marie@mail.be</td>
                                <td class="px-4 py-4 border-r-1 border-b-1">0490 12 34 56</td>
                                <td class="px-4 py-4 border-r-1 border-b-1">Bonjour j'aimerais adopter Rex
                                </td>
                                <td class="px-4 py-4 border-r-1 border-b-1">
                                    <a href="">
                                        <x-svg.pen/>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-4 py-4 border-r-1 border-b-1">Julie</td>
                                <td class="px-4 py-4 border-r-1 border-b-1">Julie@mail.be</td>
                                <td class="px-4 py-4 border-r-1 border-b-1">0498 78 98 78</td>
                                <td class="px-4 py-4 border-r-1 border-b-1">Bonjour, j'aimerais adopter Archibald</td>
                                <td class="px-4 py-4 border-r-1 border-b-1">
                                    <a href="">
                                        <x-svg.pen/>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </section>
            </div>
        </main>
    </x-layout.guest>

</div>
