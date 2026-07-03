@extends('layouts.auth')
@section('title', 'Mot de passe oublié')
@section('content')

    <div class="bg-background min-h-screen flex items-center justify-center px-6">

        <div class="w-full max-w-xl bg-element rounded-3xl shadow-md p-10">

            <h1 class="font-title text-4xl uppercase text-text text-center mb-4">
                Mot de passe oublié
            </h1>

            <p class="text-center text-text mb-8">
                Entrez votre adresse e-mail afin de recevoir un lien de réinitialisation.
            </p>

            @if(session('status'))
                <div class="mb-6 rounded-xl bg-green-100 text-green-700 p-4">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>

                    <label for="email" class="font-text">
                        Adresse e-mail
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        class="mt-2 w-full rounded-xl bg-background border-0 p-3"
                        required
                    >

                    @error('email')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <button
                    type="submit"
                    class="w-full mt-8 bg-cta hover:bg-hover text-white rounded-xl py-3 font-bold transition"
                >
                    Envoyer le lien
                </button>

            </form>

            <div class="text-center mt-8">

                <a
                    href="{{ route('login') }}"
                    class="text-text hover:underline"
                >
                    Retour à la connexion
                </a>

            </div>

        </div>

    </div>

@endsection
