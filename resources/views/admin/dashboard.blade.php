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
        <div class="col-span-3">
            <a href="#">
                <div class="bg-element h-36 rounded-2xl">
                    <div class="flex justify-between pt-6 pr-6">
                        <p class="text-6xl text-text pl-6">34</p>
                        <div class="w-16 h-16 bg-background rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 24" fill="currentColor" width="28"
                                 height="32" class="text-text">
                                <path fill-rule="evenodd"
                                      d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                    <div class="pl-6 pt-2 text-text font-medium">
                        Bénévoles
                    </div>
                </div>
            </a>
        </div>
        <div class="col-span-3">
            <a href="#">
                <div class="bg-element h-36 rounded-2xl">
                    <div class="flex justify-between pt-6 pr-6">
                        <p class="text-6xl text-text pl-6">1250</p>
                        <div class="w-16 h-16 bg-background rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28"
                                 fill="none">
                                <path
                                    d="M27.2159 12.4343C26.5336 11.0043 25.5427 9.59033 24.7191 8.51802C24.0361 7.63039 23.474 6.98929 23.2952 6.78848C23.1369 6.4778 22.5983 5.53192 21.4576 4.57751C20.1123 3.44734 17.9147 2.33959 14.6576 2.34364C14.4434 2.34364 14.2235 2.34949 13.9999 2.3589C13.7763 2.34949 13.5566 2.34364 13.3423 2.34364C10.0852 2.33959 7.88769 3.44734 6.54232 4.57751C5.40209 5.53192 4.86347 6.47741 4.70504 6.78804C4.44659 7.0781 3.43859 8.23157 2.41916 9.69211C1.83099 10.5358 1.23878 11.4803 0.784 12.4343C0.332391 13.3905 0.00448438 14.3521 0 15.2886C0.0021875 16.0431 0.191625 16.8563 0.467086 17.7009C0.882438 18.9651 1.50445 20.2943 2.08452 21.4392C2.37459 22.0112 2.65409 22.5362 2.89144 22.9787C3.12834 23.4202 3.32429 23.7829 3.43908 24.0128C3.68988 24.5141 4.03955 24.9202 4.44927 25.2053C4.85838 25.49 5.33127 25.6558 5.81924 25.6563C6.12746 25.6567 6.44016 25.5877 6.72662 25.4451C6.8326 25.3927 6.93416 25.3299 7.03057 25.2586V19.8854C7.03057 19.5895 7.27037 19.3496 7.56607 19.3496C7.86193 19.3496 8.10179 19.5895 8.10179 19.8854V22.6303C8.10179 22.6182 8.10337 22.6074 8.10337 22.5953C8.10337 22.5545 8.10337 22.5115 8.10337 22.4702C8.17666 22.5406 8.25065 22.6109 8.32814 22.6827C8.70516 23.031 9.12751 23.3914 9.56233 23.6954C10.0008 23.9966 10.4379 24.2517 10.9359 24.3589C11.6485 24.5041 12.2436 24.5547 12.7253 24.5547C13.3231 24.5552 13.7453 24.4763 14 24.4077C14.2546 24.4763 14.6769 24.5552 15.2748 24.5547C15.7565 24.5547 16.3516 24.5041 17.0641 24.3589C17.5622 24.2517 17.9993 23.9966 18.4377 23.6954C18.932 23.3493 19.4072 22.9324 19.8194 22.5415V19.8795C19.8194 19.5837 20.0592 19.3438 20.3549 19.3438C20.6507 19.3438 20.8906 19.5837 20.8906 19.8795V25.1958C21.0104 25.2935 21.1382 25.3778 21.2734 25.4451C21.5598 25.5876 21.8725 25.6566 22.1807 25.6562C22.6685 25.6558 23.1416 25.4899 23.5507 25.2052C23.9605 24.9202 24.3101 24.514 24.5609 24.0128C24.7146 23.7048 25.0101 23.1664 25.3586 22.5101C25.8829 21.5221 26.5325 20.2561 27.0579 18.9776C27.3206 18.3374 27.5526 17.6945 27.7218 17.0737C27.8904 16.4524 27.9991 15.8552 28 15.2886C27.9955 14.3521 27.6676 13.3905 27.2159 12.4343ZM9.49889 13.0655C8.95223 13.0655 8.50883 12.6222 8.50883 12.0757C8.50883 11.5288 8.95218 11.0854 9.49889 11.0854C10.0458 11.0854 10.4892 11.5288 10.4892 12.0757C10.4892 12.6222 10.0458 13.0655 9.49889 13.0655ZM16.7122 19.6994C16.3914 19.8814 16.0503 19.9625 15.7282 19.9617C15.2767 19.9612 14.8679 19.8114 14.5328 19.6039C14.3268 19.4752 14.1502 19.3232 14 19.1596C13.9314 19.234 13.8601 19.3076 13.7797 19.3762C13.3969 19.6994 12.875 19.9589 12.2719 19.9617C11.9498 19.9625 11.6086 19.8814 11.2878 19.6994C10.9664 19.5178 10.6681 19.2395 10.4056 18.8619L11.1591 18.3374C11.3578 18.6226 11.5559 18.796 11.7397 18.9001C11.9241 19.0036 12.0972 19.0431 12.2718 19.0435C12.4989 19.0439 12.7331 18.97 12.9417 18.8485C13.1496 18.7284 13.3275 18.5603 13.4313 18.4127C13.5015 18.3159 13.5353 18.2271 13.5395 18.1967L13.5408 18.1868C13.5408 17.9335 13.5408 17.6009 13.5408 17.2723C13.4987 17.2481 13.453 17.2329 13.4142 17.2015L12.1291 16.1569C11.8851 15.9592 11.7923 15.6289 11.8974 15.3321C12.0027 15.0358 12.2831 14.8377 12.5976 14.8377H15.4019C15.7166 14.8377 15.997 15.0358 16.1024 15.3321C16.2073 15.6289 16.1148 15.9592 15.8706 16.1569L14.5854 17.2015C14.5468 17.2329 14.5011 17.2476 14.4589 17.2723C14.4589 17.6009 14.4589 17.9335 14.4589 18.1868L14.4602 18.1967L14.4701 18.2325C14.4809 18.2639 14.5008 18.3074 14.5309 18.3558C14.5907 18.4535 14.6898 18.571 14.8142 18.6759C15.0641 18.8897 15.4064 19.0462 15.7281 19.0435C15.9024 19.0431 16.0755 19.0036 16.26 18.9001C16.4439 18.796 16.6419 18.6226 16.8407 18.3374L17.5943 18.8619C17.3319 19.2395 17.0336 19.5178 16.7122 19.6994ZM18.5011 13.0655C17.9545 13.0655 17.511 12.6222 17.511 12.0757C17.511 11.5288 17.9544 11.0854 18.5011 11.0854C19.048 11.0854 19.4914 11.5288 19.4914 12.0757C19.4913 12.6222 19.048 13.0655 18.5011 13.0655Z"
                                    fill="#4B2E1D"/>
                            </svg>
                        </div>
                    </div>
                    <div class="pl-6 pt-2 text-text font-medium">
                        Animaux
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
