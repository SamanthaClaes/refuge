<?php

namespace App\Policies;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchedulePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Schedule $schedule): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Schedule $schedule): bool
    {
    }

    public function delete(User $user, Schedule $schedule): bool
    {
    }

    public function restore(User $user, Schedule $schedule): bool
    {
    }

    public function forceDelete(User $user, Schedule $schedule): bool
    {
    }
}
