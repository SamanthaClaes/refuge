@extends('layouts.login')
@section('content')
    <div>
        <section>
            <h1 class="sr-only">Page de connexion</h1>
        </section>
        <div class="max-w-xl mx-auto w-full mt-8 flex flex-col justify-center items-center ">
            <img src="{{ asset('/img/Logo.png') }}" alt="Logo des pattes heureuses" width="200" height="200"
                 class="mx-auto">
            <form action="{{ route('login') }}" method="POST" class="bg-element p-6 space-y-4 rounded-lg mb-8 my-auto">
                @csrf
                <div>
                    <label for="email" id="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Elise@refuge.be"
                           class="mt-1 w-full bg-background rounded-lg px-3 py-2">
                    @error( 'email')
                    {{ $message }}
                    @enderror
                </div>
                <div x-data="{ type: 'password' }">
                    <label for="password" id="password">Mot de passe</label>
                    <div class="relative w-full">
                        <input :type="type" name="password" class=" mt-1 w-full bg-background rounded-lg px-3 py-2">


                        <button type="button" @click="type = type === 'password' ? 'text' : 'password'"
                                class="absolute inset-y-0 right-2 flex items-center text-sm cursor-pointer">

                            <img :src="type === 'password' ?
                            '{{ asset('svg/auth/v.svg') }}'
                            : '{{ asset('svg/auth/v_off.svg') }}'
                            " alt="Afficher et cacher le mot de passe">
                        </button>
                        @error( 'password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
                <div>

                    <p x-text="type"></p>
                    @error( 'password')
                    {{ $message }}
                    @enderror
                </div>
        <div>
            <a class="hover:underline" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
        </div>
        <div class="flex justify-center bg-cta rounded-lg pt-2 pb-2 hover:bg-hover">
            <button type="submit" class="text-white hover:bg-hover font-text cursor-pointer ">Se connecter</button>
        </div>
        </form>
    </div>
    @endsection
    </div>
