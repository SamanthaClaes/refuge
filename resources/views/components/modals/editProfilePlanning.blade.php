@props([
    'schedules'
])

<dialog
    wire:ignore.self
    x-on:open-planning-modal.window="$el.showModal()"
    x-on:planning-saved.window="$el.close()"
    x-cloak
>
    <x-partials.modal>

        <x-slot:title>
            <div class="flex justify-between items-center w-full">
                <span>Modifier mes disponibilités</span>

                <button
                    type="button"
                    @click="$el.closest('dialog').close()"
                    class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-background transition text-xl font-bold text-text"
                >
                    ✕
                </button>
            </div>
        </x-slot:title>

        <x-slot:body>

            <form wire:submit.prevent="savePlanning" class="space-y-5 text-text">

                @foreach($schedules as $index => $schedule)

                    <div class="bg-background rounded-xl p-4 space-y-4">

                        <div class="flex justify-between items-center">

                            <h3 class="font-semibold">
                                Disponibilité {{ $index + 1 }}
                            </h3>

                            <button
                                type="button"
                                wire:click="removeSchedule({{ $index }})"
                                class="text-red-500 hover:text-red-700 transition"
                            >
                                Supprimer
                            </button>

                        </div>

                        <div>
                            <label class="font-semibold">
                                Jour
                            </label>

                            <select
                                wire:model="schedules.{{ $index }}.day_of_week"
                                class="mt-2 w-full bg-element rounded-xl px-3 py-2"
                            >
                                <option value="monday">Lundi</option>
                                <option value="tuesday">Mardi</option>
                                <option value="wednesday">Mercredi</option>
                                <option value="thursday">Jeudi</option>
                                <option value="friday">Vendredi</option>
                                <option value="saturday">Samedi</option>
                                <option value="sunday">Dimanche</option>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">

                            <div>
                                <label class="font-semibold">
                                    Début
                                </label>

                                <input
                                    type="time"
                                    wire:model="schedules.{{ $index }}.start_time"
                                    class="mt-2 w-full bg-element rounded-xl px-3 py-2"
                                >
                            </div>

                            <div>
                                <label class="font-semibold">
                                    Fin
                                </label>

                                <input
                                    type="time"
                                    wire:model="schedules.{{ $index }}.end_time"
                                    class="mt-2 w-full bg-element rounded-xl px-3 py-2"
                                >
                            </div>

                        </div>

                    </div>

                @endforeach

                <button
                    type="button"
                    wire:click="addSchedule"
                    class="w-full rounded-xl border-2 border-dashed border-gray-300 p-3 hover:bg-background transition"
                >
                    + Ajouter une plage horaire
                </button>

                <div class="grid grid-cols-2 gap-4 mt-6">

                    <button
                        type="button"
                        @click="$el.closest('dialog').close()"
                        class="font-bold bg-red-200 rounded-xl p-3 hover:bg-red-300 transition"
                    >
                        Annuler
                    </button>

                    <button
                        type="submit"
                        class="font-bold bg-green-100 rounded-xl p-3 hover:bg-green-200 transition"
                    >
                        Enregistrer
                    </button>

                </div>

            </form>

        </x-slot:body>

    </x-partials.modal>
</dialog>
