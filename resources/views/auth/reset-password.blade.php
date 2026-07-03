@extends('layouts.auth')

@section('title', 'Réinitialiser le mot de passe')

@section('content')

    <div class="bg-background min-h-screen flex items-center justify-center px-6">

        <div class="w-full max-w-xl bg-element rounded-3xl shadow-md p-10">

            <h1 class="font-title text-4xl uppercase text-text text-center mb-4">
                Réinitialiser le mot de passe
            </h1>

            <p class="text-center text-text font-text mb-8">
                Choisissez un nouveau mot de passe pour votre compte.
            </p>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">

                @csrf

                <input
                    type="hidden"
                    name="token"
                    value="{{ $request->route('token') }}"
                >

                <div>

                    <label
                        for="email"
                        class="font-text"
                    >
                        Adresse e-mail
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $request->email) }}"
                        required
                        autofocus
                        autocomplete="username"
                        class="mt-2 w-full rounded-xl bg-background border-0 p-3"
                    >

                    @error('email')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <div>

                    <label
                        for="password"
                        class="font-text"
                    >
                        Nouveau mot de passe
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        class="mt-2 w-full rounded-xl bg-background border-0 p-3"
                    >

                    @error('password')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                    @enderror

                </div>

                <div>

                    <label
                        for="password_confirmation"
                        class="font-text"
                    >
                        Confirmation du mot de passe
                    </label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        class="mt-2 w-full rounded-xl bg-background border-0 p-3"
                    >

                </div>

                <button
                    type="submit"
                    class="w-full bg-cta hover:bg-hover text-white rounded-xl py-3 font-bold transition"
                >
                    Réinitialiser le mot de passe
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
