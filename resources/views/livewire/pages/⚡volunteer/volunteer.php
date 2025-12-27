<?php

use App\Http\Livewire\Pages\Volunteer;
use App\Jobs\ProcessAnimalAvatar;
use App\Models\Animal;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component
{

    public string $name = '';
    public string $email = '';
    public ?int $userId = null;
    public int $phone;
    public string $password = '';
    public bool $showCreateVolunteerModal = false;
    public bool $showEditVolunteerModal = false;

    public string $role = 'volunteer';

    public function getUsersProperty(): Collection
    {
        return User::where('role', 'volunteer')->get();
    }

    public function createVolunteerInDb(): void
    {
        $this->validate([
            'name'=>'required|string',
            'email'=>'required|email',
            'phone'=>'required|numeric',
        ]);

        User::create([
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'password'=>$this->password,
            'role'=>$this->role,
        ]);

        $this->showCreateVolunteerModal = false;
        $this->reset('name', 'email', 'password', 'phone', 'role');
    }



    public function createVolunteer(): void
    {
        $this->toggleModal('createVolunteer', 'open');
    }
    public function openEditVolunteerModal($userId): void
    {
        $user = User::findOrFail($userId);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;

        $this->toggleModal('editVolunteer', 'open');
    }
    public function editVolunteer(): void
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email'=>'required|email|unique:users,email,'. $this->userId,
            'phone'=>'required',
        ]);

        $user = User::findOrFail($this->userId);
        $user->update($validated);
        $this->toggleModal('editVolunteer', 'close');
        $this->reset(['name', 'email', 'phone']);

    }
    public function toggleModal($modalType, $action): void
    {
        if ($modalType === 'createVolunteer') {
            $this->showCreateVolunteerModal = $action === 'open';
            $action === 'open' ? $this->dispatch('open-modal') : $this->dispatch('close-modal');
        } elseif ($modalType === 'editVolunteer') {
            $this->showEditVolunteerModal = $action === 'open';
            $action === 'open' ? $this->dispatch('open-modal') : $this->dispatch('close-modal');
        }
    }
};
