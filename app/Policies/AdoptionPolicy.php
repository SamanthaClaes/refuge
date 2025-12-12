<?php

namespace App\Policies;

use App\Models\Adoption;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdoptionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Adoption $adoption): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Adoption $adoption): bool
    {
    }

    public function delete(User $user, Adoption $adoption): bool
    {
    }

    public function restore(User $user, Adoption $adoption): bool
    {
    }

    public function forceDelete(User $user, Adoption $adoption): bool
    {
    }
}
