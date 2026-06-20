<dialog
    wire:ignore.self
    x-on:open-edit-modal.window="$el.showModal()"
    x-on:animal-edited.window="$el.close()"
    x-cloak
>
    <x-partials.modal>
        <div class="flex justify-around">
            <x-slot:title>
                Modifier un animal
                <button type="button" class="p-2"  @click="$el.closest('dialog').close()">
                    <img src="{{ asset('svg/close.svg') }}" alt="croix" height="30" width="30">
                </button>
            </x-slot:title>
        </div>
        <x-slot:body>
            <form wire:submit.prevent="editAnimal" class="space-y-2" enctype="multipart/form-data">
                <div>
                    <label for="avatar">Choisir l’avatar</label>
                    <input type="file" wire:key="avatar-input" wire:model="avatar"
                           class="mt-1 w-full bg-background rounded-lg pl-2 font-text" id="avatar" name="avatar">
                </div>
                <div>
                    <label for="avatar_path">Choisir les avatars</label>
                    <input type="file" multiple wire:key="avatar_path-input" wire:model="avatar_path"
                           class="mt-1 w-full bg-background rounded-lg pl-2 font-text" id="avatar_path"
                           name="avatar_path[]">
                </div>
                <div>
                    <label for="name" id="name"> Nom </label>
                    <input wire:model="name" class="mt-1 w-full bg-background rounded-lg pl-2 font-text" type="text"
                           id="name"
                           name="name">
                </div>
                <div class="flex justify-between gap-4 ">
                    <div class="flex flex-col">
                        <label for="specie" id="specie">{{ __('modal.specie') }}</label>
                        <select wire:model="specie" id="specie" name="specie"
                                class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                            <option value="">Choisir une espèce</option>
                            <option value="dog">chien</option>
                            <option value="cat">chat</option>
                            <option value="birds">oiseau</option>
                            <option value="bunny">lapin</option>
                            <option value="rat">rat</option>
                            <option value="ferret">furet</option>
                        </select>
                    </div>
                    <div class="flex flex-col">
                        <label for="breed" id="breed">Race</label>
                        <input wire:model="breed" type="text" id="breed" name="breed"
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                    </div>
                    <div class="flex flex-col">
                        <label for="gender" id="gender">Genre</label>
                        <select class="mt-1 w-full bg-background rounded-lg pl-2 font-text" wire:model="gender">
                            <option value="1">Mâle</option>
                            <option value="0">Femelle</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="age" id="age">Date de naissance</label>
                    <input wire:model="age" type="date" id="age" name="age"
                           class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                </div>
                <div>
                    <label for="status">Statut</label>
                    <select wire:model="status" class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
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
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                        <label for="closed_at">Date clôture adoption</label>
                        <input type="date" wire:model="adoptionClosedAt" id="closed_at"
                               class="mt-1 w-full bg-background rounded-lg pl-2 font-text">
                    </div>
                </div>
                <div>
                    <label for="status" id="status">Vaccin</label>
                    <select class="mt-1 w-full bg-background rounded-lg pl-2 font-text" wire:model="vaccine">
                        <option value="">Choisir une option</option>
                        <option value="1">Vacciné</option>
                        <option value="0">Pas de vaccin</option>
                    </select>
                </div>
                <div>
                    <label for="description" id="description">Description</label>
                    <textarea
                        id="description"
                        class="mt-1 w-full bg-background rounded-lg pl-2 font-text h-30 resize-none"
                        wire:model="description">
                          </textarea>
                    <div class="flex justify-around items-center p-2 gap-4">
                        <button type="button"  @click="$el.closest('dialog').close()"
                                class="text-cta font-bold border-2 border-solid border-cta rounded-lg p-2 w-full hover:bg-gray-100">
                            Annuler
                        </button>
                        <button type="submit"
                                class="text-white font-bold bg-cta rounded-lg p-2 w-full border-2 border-cta hover:bg-hover">
                            Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </x-slot:body>
    </x-partials.modal>
</dialog>
