<?php

namespace App\Policies;

use App\Models\Adopter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdopterPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Adopter $adopter): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Adopter $adopter): bool
    {
    }

    public function delete(User $user, Adopter $adopter): bool
    {
    }

    public function restore(User $user, Adopter $adopter): bool
    {
    }

    public function forceDelete(User $user, Adopter $adopter): bool
    {
    }
}
