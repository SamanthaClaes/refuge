<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Accueil</title>
</head>
<body class="bg-background">
<x-header/>
<main>
    <p class="text-p text-center mt-16 mb-5 font-bold font-text"><small>124 animaux adoptés cette année</small></p>
    <h1 class=" mx-auto text-xl text-center md:text-6xl text-text font-title md:w-2xl md:mx-auto uppercase">Refuge des
        pattes heureuses</h1>
    <div class="flex justify-center">
        <img src="{{ asset('img/empreintes.svg') }}" alt="empreinte de pattes avec une photo des animaux">
    </div>
    <h2 class="text-center text-xl md:text-3xl text-text font-title uppercase mb-4">Nos derniers arrivants</h2>
    <p class="mx-auto text-center font-text text-text mb-10">Voici nos derniers arrivants, découvrez si vous êtes fait
        l’un
        pour l’autre</p>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-6 px-4 sm:px-8 lg:ml-40 lg:mr-40 lg:mb-15 pb-3">
        <x-cards.animal-card sex="Male" name="Moka" age="2 ans"/>
        <x-cards.animal-card sex="Male" name="Moka" age="2 ans"/>
        <x-cards.animal-card sex="Male" name="Moka" age="2 ans"/>
    </div>
    <div class="bg-cta flex justify-center items-center rounded-xl p-4 mx-auto max-w-md mb-40 hover:bg-hover">
        <a href="/animals" class="text-white font-text text-lg">Voir tout nos pensionnaires !</a>
    </div>
    <h2 class="text-xl text-center font-title md:text-3xl text-text uppercase">Nous contacter</h2>
    <p class="text-center text-text font-text px-6 mt-4 md:w-3xl md:mx-auto mb-8">Une question, une envie d’adopter ou
        simplement un mot
        gentil ? N’hésitez pas à nous écrire via notre formulaire de contact. L’équipe des Pattes Heureuses vous
        répondra au plus vite !
    </p>
    <x-forms.contact_form>
    </x-forms.contact_form>
</main>
<x-footer/>
</body>
</html>
