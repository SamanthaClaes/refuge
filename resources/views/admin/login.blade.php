<x-layout.guest title="Login">
<section>
    <h1 class="sr-only">Page de connexion</h1>
</section>
<div class="max-w-xl mx-auto w-full mt-8 flex flex-col justify-center items-center ">
        <img src="{{ asset('/img/Logo.png') }}" alt="Logo des pattes heureuses" width="200" height="200" class="mx-auto">
    <form action="#" method="get" class="bg-element p-6 space-y-4 rounded-lg mb-8 my-auto">
        <div>
            <label for="mail" id="mail">Email</label>
            <input type="text" id="mail" name="mail" placeholder="Elise@refuge.be"
                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
        </div>
        <div>
            <label for="password" id="phone">Mot de passe</label>
            <input type="password" id="password" name="password"
                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
        </div>
        <div>
            <a class="hover:underline" href="#">Mot de passe oublié ?</a>
        </div>
        <div class="flex justify-center bg-cta rounded-lg pt-2 pb-2 hover:bg-hover">
            <button type="submit" class="text-white hover:bg-hover font-text cursor-pointer ">Se connecter</button>
        </div>
    </form>
</div>
</x-layout.guest>
