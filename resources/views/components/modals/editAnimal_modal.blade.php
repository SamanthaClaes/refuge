@props([
    'avatar' => null,
    'currentAvatar' => null,
])

<dialog
    wire:ignore.self
    x-on:open-edit-modal.window="$el.showModal()"
    x-on:animal-edited.window="$el.close()"
    x-cloak
>
    <x-partials.modal>
        <div class="flex justify-around items-center w-full">
            <x-slot:title>
                Modifier un animal
                <button
                    type="button"
                    @click="$el.closest('dialog').close()"
                    class="text-2xl font-bold cursor-pointer hover:text-red-500 transition-colors"
                    aria-label="Fermer"
                >
                    ✕
                </button>
            </x-slot:title>
        </div>
        <x-slot:body>
            <form wire:submit.prevent="editAnimal" class="space-y-5 text-text" enctype="multipart/form-data">
                <div>
                    <img
                        src="{{ $avatar ? $avatar->temporaryUrl() : $currentAvatar }}"
                        alt="Prévisualisation"
                        class="w-40 h-40 rounded-2xl object-cover"
                    >
                    <label for="avatar">Choisir l’avatar</label>
                    <input type="file" wire:key="avatar-input" wire:model="avatar"
                           class="mt-1 w-full bg-element rounded-lg pl-2 font-text" id="avatar" name="avatar">
                </div>
                <div>
                    <label for="avatar_path">Choisir les avatars</label>
                    <input type="file" multiple wire:key="avatar_path-input" wire:model="avatar_path"
                           class="mt-1 w-full bg-element rounded-lg pl-2 font-text" id="avatar_path"
                           name="avatar_path[]">
                </div>
                <div>
                    <label for="name" id="name"> Nom </label>
                    <input wire:model="name" class="mt-1 w-full bg-element rounded-lg pl-2 font-text" type="text"
                           id="name"
                           name="name">
                </div>
                <div class="flex gap-4 ">
                    <div class="flex-1">
                        <label for="animal_type_id" id="animal_type_id" class="font-semibold text-text">Espèces</label>
                        <select
                            wire:model.live="animal_type_id"
                            id="animal_type_id"
                            class="mt-2 w-full bg-element rounded-xl px-3 py-2 font-text"
                        >
                            <option value="">Choisir une espèce</option>

                            @foreach($this->animalTypes as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="breed_id" class="font-semibold text-text">
                            Race
                        </label>

                        <select
                            wire:model="breed_id"
                            id="breed_id"
                            class="mt-2 w-full bg-element rounded-xl px-3 py-2 font-text"
                        >
                            <option value="">
                                Choisir une race
                            </option>

                            @foreach($this->breeds as $breed)
                                <option value="{{ $breed->id }}">
                                    {{ $breed->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1">
                        <label for="gender" id="gender" class="font-semibold text-text">Genre</label>
                        <select class="mt-2 w-full bg-element rounded-xl px-3 py-2 font-text" wire:model="gender">
                            <option value="1">Mâle</option>
                            <option value="0">Femelle</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="age" id="age">Date de naissance</label>
                    <input wire:model="age" type="date" id="age" name="age"
                           class="mt-1 w-full bg-element rounded-lg pl-2 font-text">
                </div>
                <div>
                    <label for="status">Statut</label>
                    <select wire:model="status" class="mt-1 w-full bg-element rounded-lg pl-2 font-text">
                        <option value="">Choisir un statut</option>
                        <option value="disponible">Disponible</option>
                        <option value="en attente">En attente</option>
                        <option value="en soins">En soins</option>
                        <option value="adopté(e)">Adopté(e)</option>
                    </select>
                </div>
                <div>
                    <div>
                        <label for="adoption_start">Date début adoption (optionnelle)</label>
                        <input type="date" wire:model="adoptionStartDate" id="adoption_start"
                               class="mt-1 w-full bg-element rounded-lg pl-2 font-text">
                        <label for="closed_at">Date clôture adoption</label>
                        <input type="date" wire:model="adoptionClosedAt" id="closed_at"
                               class="mt-1 w-full bg-element rounded-lg pl-2 font-text">
                    </div>
                </div>
                <div>
                    <label for="status" id="status">Vaccin</label>
                    <select class="mt-1 w-full bg-element rounded-lg pl-2 font-text" wire:model="vaccine">
                        <option value="">Choisir une option</option>
                        <option value="1">Vacciné</option>
                        <option value="0">Pas de vaccin</option>
                    </select>
                </div>
                <div>
                    <label for="description" id="description">Description</label>
                    <textarea
                        id="description"
                        class="mt-1 w-full bg-element rounded-lg pl-2 font-text h-30 resize-none"
                        wire:model="description">
                          </textarea>
                    <div class="flex justify-around items-center p-2 gap-4">
                        <button type="button"  @click="$el.closest('dialog').close()"
                                class="font-medium bg-red-200 rounded-lg p-2 w-full hover:bg-red-300">
                            Annuler
                        </button>
                        <button type="submit"
                                class=" font-medium bg-green-100 rounded-lg p-2 w-full  hover:bg-green-200">
                            Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </x-slot:body>
    </x-partials.modal>
</dialog>
