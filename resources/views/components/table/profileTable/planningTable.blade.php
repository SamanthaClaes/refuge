@props([
    'days',
    'schedules'
])
<section class="bg-element rounded-3xl p-8 shadow-md">
<div class="flex justify-between items-center mb-8">

    <h2 class="font-title text-3xl text-text uppercase">
        Mes disponibilités
    </h2>

    <button
        type="button"
        wire:click="openPlanningModal"
        class="bg-cta hover:bg-hover text-white rounded-xl px-6 py-3 cursor-pointer"
    >
        Modifier
    </button>

</div>
    <table class="w-full border-collapse">

    <thead class="bg-background">

    <tr>

        <th class="border border-text p-4">Lundi</th>
        <th class="border border-text p-4">Mardi</th>
        <th class="border border-text p-4">Mercredi</th>
        <th class="border border-text p-4">Jeudi</th>
        <th class="border border-text p-4">Vendredi</th>
        <th class="border border-text p-4">Samedi</th>
        <th class="border border-text p-4">Dimanche</th>

    </tr>

    </thead>

    <tbody>

    @foreach($days as $day)
        <x-table.table-data>

            @forelse( Auth::user()->schedules->where('day_of_week', $day) as $schedule)

                <div>
                    {{ Carbon::parse($schedule->start_time)->format('H:i') }}
                    -
                    {{ Carbon::parse($schedule->end_time)->format('H:i') }}
                </div>

            @empty

                <span class="text-text">
                                         Indisponible
                                        </span>

            @endforelse

        </x-table.table-data>
    @endforeach
    </tbody>

</table>
</section>
