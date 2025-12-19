<x-layout.guest title="Fiche Animale">
    <x-header.header/>
    <main>
        <section>
            <h1 class="sr-only">Fiche détaillée de l'animal</h1>
            <div  class="grid grid-cols-12 gap-4 mx-8 mt-8 ml-8">
                <div class="col-span-6 ">
                    <img
                        src="{{ $animal->avatar_path ? asset('storage/avatars/original/' . basename($animal->avatar_path)) : '' }}"
                        alt="{{ $animal->name }}"
                        class="rounded-lg w-full h-90 object-cover reveal-on-scroll"
                    >
                </div>
                <div class="bg-element col-span-6 rounded-2xl">
                    <p class="font-title text-text uppercase text-6xl text-center pb-8 pt-8">{{$animal->name}}</p>
                    <div class="flex justify-around  items-center">
                        <p class="font-title text-text uppercase text-2xl text-center pb-8">{{$animal->gender ? __('animals.male') : __('animals.female')}}</p>
                        <p class="font-title text-text uppercase text-2xl text-center pb-8">{{$animal->vaccine ? 'vacciné(e)' : 'pas vacciné(e)' }}</p>
                        <p class="font-title text-text uppercase text-2xl text-center pb-8">{{$animal->age->format('d/m/Y')}}</p>
                    </div>
                    <p class="font-text text-text text-xl/10 text-center pb-8 max-w-2xl mx-auto">
                       {{$animal->description}}
                    </p>
                </div>
                @foreach($animal->avatars as $avatar)
                    <div class="col-span-2">
                        <img src="{{ asset('storage/' . $avatar->path) }}" alt="{{ $animal->name }}" class="w-full h-65 object-cover rounded-xl transition-transform duration-300 hover:scale-105">
                    </div>
                @endforeach
                <div class="col-span-6">
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
                            <button type="submit" class="text-white hover:bg-hover font-text cursor-pointer ">Envoyez votre demande d'adoption</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    <x-footer/>
</x-layout.guest>
