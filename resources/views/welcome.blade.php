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
    <p class="text-p text-center"><small>124 animaux adoptés cette année</small></p>
    <h1 class="text-center text-6xl text-text font-title w-2xl mx-auto uppercase">Refuge des pattes heureuses</h1>
    <div class="flex justify-center">
        <img src="{{ asset('img/empreintes.svg') }}" alt="empreinte de pattes avec une photo des animaux">
    </div>
    <h2 class="text-center text-3xl text-text font-title uppercase">Nos derniers arrivants</h2>
    <p class="mx-auto text-center font-text text-text mb-8">Voici nos derniers arrivants, découvrez si vous êtes fait l’un
        pour l’autre</p>
    <div class="flex flex-row justify-center gap-2 pb-3 mb-8">
        <x-cards.animal-card/>
        <x-cards.animal-card/>
        <x-cards.animal-card/>
    </div>
    <h2 class="text-center font-title text-3xl text-text uppercase">Nous contacter</h2>
    <p class="text-center text-text font-text w-3xl mx-auto mb-8">Une question, une envie d’adopter ou simplement un mot
        gentil ? N’hésitez pas à nous écrire via notre formulaire de contact. L’équipe des Pattes Heureuses vous
        répondra au plus vite !
    </p>
    <div class="max-w-xl mx-auto w-full">
        <form action="#" method="get" class="bg-element p-6 space-y-4 rounded-lg">
            <div class="flex justify-around gap-4">
                <div>
                    <label for="name" id="name">Nom</label>
                    <input type="text" name="name" id="name" placeholder="Dupont" class="mt-1 w-full bg-background rounded-lg pl-2">
                </div>
                <div>
                    <label for="firstName" id="firstName">Prénom</label>
                    <input type="text" name="firstName" id="firstName" placeholder="Jean" class="mt-1 w-full bg-background rounded-lg pl-2">
                </div>
            </div>
            <div>
                <label for="mail" id="mail">Email</label>
                <input type="text" id="mail" name="mail" placeholder="example : jean@dupont.be"
                       class="mt-1 w-full bg-background rounded-lg pl-2">
            </div>
            <div>
                <label for="phone" id="phone">Téléphone</label>
                <input type="tel" id="phone" name="phone" placeholder="+32 456789011"
                       class="mt-1 w-full bg-background rounded-lg pl-2">
            </div>
            <div>
                <label for="message" id="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="10"
                          class="mt-1 w-full bg-background rounded-lg resize-none"></textarea>
            </div>
            <div class="flex justify-center bg-cta rounded-lg pt-2 pb-2 hover:bg-hover">
                <button type="submit" class="text-white hover:bg-hover">Envoyez un message</button>
            </div>
        </form>
    </div>


</main>
<x-footer/>
</body>
</html>
