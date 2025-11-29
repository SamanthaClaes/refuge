<div class="col-span-1 sm:col-span-1 md:col-span-4   lg:col-span-4">
    <div class="bg-element h-auto rounded-xl p-3 w-full">
        <div class="pl-2 pt-2 pr-2 pb-6 relative">
            <img src="{{ asset('img/animals/berger-allemand.jpg') }}" alt="berger Allemand allongé sur de la pelouse"
                 width="421" height="289" class="rounded-lg w-full h-auto reveal-on-scroll">
            <div class=" reveal-on-scroll absolute top-4 right-4 bg-status text-white font-text rounded-sm p-1 text-sm sm:text-base">
                Disponible
            </div>
        </div>
        <p class="font-title uppercase text-text text-2xl sm:text-3xl pb-6 pl-2"> {{ $name }}</p>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center pb-6 pl-2 gap-2 sm:gap-0">
            <p class="font-text text-text text-base sm:text-lg">Sexe : {{ $sex }}</p>
            <p class="font-text text-text text-base sm:text-lg">Age : {{ $age }}</p>
        </div>
        <div class="bg-cta flex justify-center rounded-lg h-12 items-center hover:bg-hover">
            <a href="/details" class="font-text text-white text-lg sm:text-xl">Adopter {{ $name }}</a>
        </div>
    </div>
</div>
