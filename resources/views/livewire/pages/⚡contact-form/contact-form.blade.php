<div class="max-w-xl mx-auto w-full">
    <form wire:submit.prevent="submit" class="bg-element p-6 space-y-4 rounded-lg mb-8" id="contact-form">
        <div class="flex justify-around gap-4">
            <div>
                <label for="name" class="block font-text mb-2">{{ __('welcome.name') }}</label>
                <input type="text" id="name" wire:model="name" placeholder="Dupont"
                       class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                @error('name')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="firstName" class="block font-text mb-2">{{ __('welcome.firstname') }}</label>
                <input type="text" id="firstName" wire:model="firstName" placeholder="Jean"
                       class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                @error('firstName')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div>
            <label for="email" class="block font-text mb-2">{{ __('welcome.email') }}</label>
            <input type="email" id="email" wire:model="email" placeholder="example : jean@dupont.be"
                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
            @error('email')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="phone" class="block font-text mb-2">{{ __('welcome.phone') }}</label>
            <input type="tel" id="phone" wire:model="phone" placeholder="+32 456789011"
                   class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
            @error('phone')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="message" class="block font-text mb-2">{{ __('welcome.message') }}</label>
            <textarea id="message" wire:model="message" rows="10"
                      class="mt-1 w-full bg-background rounded-lg resize-none font-text"></textarea>
            @error('message')
            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-center bg-cta rounded-lg pt-2 pb-2 hover:bg-hover">
            <button type="submit" class="text-white hover:bg-hover font-text cursor-pointer">
                {{ __('welcome.sent') }}
            </button>
        </div>
    </form>
    @if( session('success') )
        <div class="max-w-4xl mx-auto p-4 mb-4 text-green-700 bg-green-100 border border-green-200 rounded animate-fade-up-out">
            {{ session('success') }}
        </div>
    @endif
</div>
