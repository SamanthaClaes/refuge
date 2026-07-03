<?php

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Schedule;

new class extends Component {
    public array $schedules = [];
    public ?int $planningUserId = null;

    public $days =
        [
            'monday',
            'tuesday',
            'wednesday',
            'thursday',
            'friday',
            'saturday',
        ];

    public function getUsersProperty()
    {
        return User::with('schedules')
            ->where('role', 'volunteer')
            ->get();
    }

    public function openCreatePlanningModal(): void
    {
        $this->planningUserId = null;

        $this->schedules = [
            [
                'day_of_week' => 'monday',
                'start_time' => '09:00',
                'end_time' => '17:00',
            ]
        ];

        $this->dispatch('open-planning-modal');
    }

    public function openPlanningModal(int $userId): void
    {
        $this->planningUserId = $userId;

        $this->schedules = Schedule::where('user_id', $userId)
            ->orderBy('day_of_week')
            ->get()
            ->toArray();

        $this->dispatch('open-planning-modal');
    }

    public function savePlanning(): void
    {
        $this->validate([
            'planningUserId' => ['required', 'exists:users,id'],
            'schedules' => ['required', 'array', 'min:1'],
            'schedules.*.day_of_week' => ['required'],
            'schedules.*.start_time' => ['required'],
            'schedules.*.end_time' => ['required'],
        ]);

        Schedule::where('user_id', $this->planningUserId)->delete();

        foreach ($this->schedules as $schedule) {
            Schedule::create([
                'user_id' => $this->planningUserId,
                'day_of_week' => $schedule['day_of_week'],
                'start_time' => $schedule['start_time'],
                'end_time' => $schedule['end_time'],
            ]);
        }
        $this->reset([
            'planningUserId',
            'schedules',
        ]);

        $this->dispatch('planning-saved');
    }

    public function addSchedule(): void
    {
        $this->schedules[] = [
            'day_of_week' => 'monday',
            'start_time' => '09:00',
            'end_time' => '17:00',
        ];
    }

    public function removeSchedule(int $index): void
    {
        unset($this->schedules[$index]);

        $this->schedules = array_values($this->schedules);
    }
};

?>

<div>
    <div class="flex justify-between items-center mt-8">
        <h2 class="pt-8 font-semibold text-text text-xl pb-4">Planning des bénévoles</h2>
        <x-cta.addPlanningVolunteer title="+ Ajouter un planning"/>
    </div>
    <section class="p-4 bg-element rounded-2xl">
        <div class="rounded-lg overflow-clip border">
            <table class="w-full">
                <thead>
                <tr class="bg-background">
                    <th class="p-3 border-r">Nom</th>
                    <th class="p-3 border-r">Lundi</th>
                    <th class="p-3 border-r">Mardi</th>
                    <th class="p-3 border-r"> Mercredi</th>
                    <th class="p-3 border-r">Jeudi</th>
                    <th class="p-3 rounded-l-lg border-r">Vendredi</th>
                    <th class="p-3 rounded-l-lg">Samedi</th>
                    <th class="p-3 rounded-l-lg">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse( $this->users as  $key => $user)
                    <tr>
                        <x-table.table-data>
                            {{ $user->name }}
                        </x-table.table-data>
                        @foreach($days as $day)
                            <x-table.table-data>
                                @forelse($user->schedules->where('day_of_week', $day) as $schedule)
                                    {{ Carbon::parse($schedule->start_time)->format('H:i') }}
                                    -
                                    {{ Carbon::parse($schedule->end_time)->format('H:i') }}

                                @empty
                                    —
                                @endforelse
                            </x-table.table-data>
                        @endforeach
                        <x-table.table-data is-last="true">
                            <div x-data="{ open: false }" class="relative flex justify-center">

                                <button
                                    type="button"
                                    @click="open = !open"
                                    class="px-3 py-1 rounded bg-element hover:bg-hover cursor-pointer"
                                >
                                    ⋮
                                </button>

                                <div
                                    x-show="open"
                                    @click.outside="open = false"
                                    x-cloak
                                    class="absolute right-0 mt-2 w-40 bg-white border rounded-lg shadow-lg z-50"
                                >
                                    <button
                                        type="button"
                                        wire:click="openPlanningModal({{ $user->id }})"
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100"
                                    >
                                        Modifier
                                    </button>
                                </div>
                            </div>
                        </x-table.table-data>
                    </tr>

                </tbody>
                @empty
                    <p> Pas de bénévoles</p>
                @endforelse
            </table>
        </div>
    </section>
    <div>
        <x-modals.createPlanning_modal
            :schedules="$this->schedules"
        />
    </div>
</div>
