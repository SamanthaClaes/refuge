<x-layout.guest title="Liste des animaux">
    <x-header/>
    <section class="relative w-full h-[60vh] overflow-hidden">
        <img src="{{ asset('img/animals/chien.jpg') }}"
             alt=""
             class="absolute inset-0 w-full h-full object-cover animate-fadeZoom">

        <div class="absolute inset-0 bg-black/60"></div>

        <h2 class="absolute inset-0 flex items-center justify-center
               text-white text-3xl font-bold font-title uppercase z-10">
            Chaque adoption change deux vies : la leur et la vôtre.
        </h2>
    </section>

    <section>
    <h2 class="font-title uppercase text-3xl text-text pt-20 mb-4 ml-40">Découvrez nos pensionnaires</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-12 gap-4 lg:ml-40 mb-10">
        <div class="col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
            <label class="pl-1" for="race">Race</label>
            <select name="race" id="race" class="bg-element rounded-lg p-3 w-full mt-1">
                <option value="">Choisir une race</option>
                <option value="bergerAllemand">Berger Allemand</option>
                <option value="chihuahua">Chihuahua</option>
                <option value="caniche">Caniche</option>
                <option value="persan">Persan</option>
                <option value="british">British</option>
                <option value="calopsitte">Calopsitte</option>
                <option value="lapinNain">Lapin Nain</option>
            </select>
        </div>
        <div class="col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
            <label class="pl-1" for="espece">Espèces</label>
            <select name="especes" id="especes" class="bg-element  rounded-lg p-3 w-full  mt-1">
                <option value=""> Choisir une espèces</option>
                <option value="dog">Chien</option>
                <option value="cat">Chat</option>
                <option value="birds">Oiseaux</option>
                <option value="bunny">Lapin</option>
                <option value="rat">Rat</option>
            </select>
        </div>
        <div class="col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
            <label class="pl-1" for="age">Age</label>
            <select name="age" id="age" class="bg-element  rounded-lg p-3 w-full  mt-1">
                <option value="">Choisir un age</option>
                <option value="1">1 mois</option>
                <option value="2">2 mois</option>
                <option value="3">3 mois</option>
                <option value="4">4 mois</option>
                <option value="5">5 mois</option>
            </select>
        </div>
        <div class="col-span-1 sm:col-span-1 md:col-span-2 lg:col-span-2">
            <label class="pl-1" for="pelage">Pelage</label>

            <select name="pelage" id="pelage" class="bg-element rounded-lg p-3 w-full  mt-1">
                <option value="">Choisir un pelage</option>
                <option value="bringe">Bringé</option>
                <option value="EcailleDeTortue">Écaille de tortue</option>
                <option value="bleuCobalt">Bleu cobalt</option>
                <option value="rex">Rex</option>
                <option value="dumboRex">Dumbo Rex</option>
            </select>
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-6 lg:ml-40 lg:mr-40 lg:mb-40 pb-3">
    <x-cards.animal-card sex="Male" name="Norbert" age="18 ans"/>
            <x-cards.animal-card sex="Male" name="Norbert" age="18 ans"/>
            <x-cards.animal-card sex="Male" name="Norbert" age="18 ans"/>
            <x-cards.animal-card sex="Male" name="Norbert" age="18 ans"/>
            <x-cards.animal-card sex="Male" name="Norbert" age="18 ans"/>
            <x-cards.animal-card sex="Male" name="Norbert" age="18 ans"/>
            <x-cards.animal-card sex="Male" name="Norbert" age="18 ans"/>
            <x-cards.animal-card sex="Male" name="Norbert" age="18 ans"/>
            <x-cards.animal-card sex="Male" name="Norbert" age="18 ans"/>
    </div>
</section>
<x-footer/>
</x-layout.guest>
