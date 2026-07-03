<?php

use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Schedule;

new #[Layout('layouts.admin', ['title' => 'Dashboard | Mon profil'])]
class extends Component {
    use WithFileUploads;

    public User $user;

    public $avatar;

    public array $days = [
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
    ];

    public string $currentPassword = '';
    public string $newPassword = '';
    public string $newPasswordConfirmation = '';
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public array $schedules = [];
    public ?int $planningUserId = null;

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->email = Auth::user()->email;
        $this->name = Auth::user()->name;
        $this->phone = Auth::user()->phone;

        $this->schedules = Schedule::where('user_id', $this->user->id)
            ->orderBy('day_of_week')
            ->get()
            ->toArray();
    }

    public function updateData(): void
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'phone' => 'nullable|string|max:30',
            'avatar' => 'nullable|image|max:10240',
        ]);
        $user = auth()->user();

        $user->name = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;

        if ($this->avatar) {
            $user->avatar = $this->avatar->store('avatars', 'public');
        }

        $user->save();
        $this->user->refresh();

        $this->reset('avatar');
        $this->dispatch('profile-updated');

    }

    public function updatePw(): void
    {
        $this->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8|same:newPasswordConfirmation',
        ]);

        $user = auth()->user();

        if (!Hash::check($this->currentPassword, $user->password)) {
            $this->addError('currentPassword', 'Mot de passe incorrect.');
            return;
        }

        $user->password = Hash::make($this->newPassword);
        $user->save();

        $this->reset([
            'currentPassword',
            'newPassword',
            'newPasswordConfirmation',
        ]);
    }

    public function openPlanningModal(): void
    {
        $this->planningUserId = auth()->id();

        $this->schedules = Schedule::where('user_id', $this->planningUserId)
            ->orderBy('day_of_week')
            ->get()
            ->toArray();
        if (empty($this->schedules)) {
            $this->addSchedule();
        }


        $this->dispatch('open-planning-modal');
    }

    public function addSchedule(): void
    {
        $this->schedules[] = [
            'day_of_week' => 'monday',
            'start_time' => '09:00',
            'end_time' => '17:00',
        ];
    }

    public function savePlanning(): void
    {
        $this->validate([
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

    public function removeSchedule(int $index): void
    {
        unset($this->schedules[$index]);

        $this->schedules = array_values($this->schedules);
    }

    public function openEditProfileModal(): void
    {
        $this->dispatch('open-edit-profile-modal');
    }

    public function openAvatarModal(): void
    {
        $this->dispatch('open-avatar-modal');
    }

    public function updateAvatar(): void
    {
        $this->validate([
            'avatar' => 'required|image|max:10240',
        ]);

        $path = $this->avatar->store('avatars', 'public');

        $this->user->update([
            'avatar' => $path,
        ]);
        $this->dispatch('avatar-updated');
    }
};
?>

<div>
    <div class="bg-background min-h-screen py-12">

        <div class="max-w-5xl mx-auto px-6">

            <h1 class="font-title text-5xl text-center text-text uppercase mb-12">
                Mon profil
            </h1>

            <div class="flex flex-col items-center mb-10">

                <div class="relative">

                    <img
                        src="{{ $user->getAvatarUrl() }}"
                        class="w-40 h-40 rounded-full object-cover border-4 border-element shadow-lg"
                        alt="Photo de profil"
                    >
                    <label
                        aria-label="Modifier la photo"
                        title="Modifier la photo"
                        wire:click="openAvatarModal"
                        for="avatar"
                        class="absolute bottom-0 right-2 bg-cta hover:bg-hover rounded-full p-3 cursor-pointer transition"
                    >
                        ✎
                    </label>

                </div>

            </div>

            <div class="space-y-10">
                <x-table.profileTable.informations
                    :user="$user"
                />
                <x-table.profileTable.passwordTable/>

                <x-table.profileTable.planningTable
                    :days="$days"
                    :schedules="$schedules"
                />
            </div>

        </div>
    </div>
    <x-modals.editInfo/>
    <x-modals.editImage
        :user="$user"
        :avatar="$avatar"
    />
    <x-modals.editProfilePlanning
        :schedules="$schedules"
    />
</div>
