<section class="bg-element rounded-3xl p-8 shadow-md">

    <h2 class="font-title text-3xl text-text uppercase mb-8">
        Sécurité
    </h2>

    <form wire:submit.prevent="updatePw" class="grid gap-6">

        <div>

            <label>Mot de passe actuel</label>

            <input
                type="password"
                wire:model="currentPassword"
                class="mt-2 w-full rounded-xl border-0 p-3 bg-background"
            >
            @error('currentPassword')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>

            <label>Nouveau mot de passe</label>

            <input
                type="password"
                wire:model="newPassword"
                class="mt-2 w-full rounded-xl border-0 p-3 bg-background"
            >
            @error('newPassword')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>

            <label>Confirmation</label>

            <input
                type="password"
                wire:model="newPasswordConfirmation"
                class="mt-2 w-full rounded-xl border-0 p-3 bg-background"
            >

        </div>
        <div class="flex justify-center mt-8">
            <button
                type="submit"
                class="bg-cta hover:bg-hover text-white rounded-xl px-8 py-3 transition cursor-pointer"
            >
                Modifier le mot de passe
            </button>
        </div>
    </form>

</section>
