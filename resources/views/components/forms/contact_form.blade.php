<div class="max-w-xl mx-auto w-full">
    <form action="#" method="get" class="bg-element p-6 space-y-4 rounded-lg mb-8">
        <div class="flex justify-around gap-4">
            <div>
                <label for="name" id="name">Nom</label>
                <input type="text" name="name" id="name" placeholder="Dupont" class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
            </div>
            <div>
                <label for="firstName" id="firstName">Prénom</label>
                <input type="text" name="firstName" id="firstName" placeholder="Jean" class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
            </div>
        </div>
        <div>
            <label for="mail" id="mail">Email</label>
            <input type="text" id="mail" name="mail" placeholder="example : jean@dupont.be"
                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
        </div>
        <div>
            <label for="phone" id="phone">Téléphone</label>
            <input type="tel" id="phone" name="phone" placeholder="+32 456789011"
                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
        </div>
        <div>
            <label for="message" id="message">Message</label>
            <textarea name="message" id="message" cols="30" rows="10"
                      class="mt-1 w-full bg-background rounded-lg resize-none font-text"></textarea>
        </div>
        <div class="flex justify-center bg-cta rounded-lg pt-2 pb-2 hover:bg-hover">
            <button type="submit" class="text-white hover:bg-hover font-text cursor-pointer ">Envoyez un message</button>
        </div>
    </form>
</div>
