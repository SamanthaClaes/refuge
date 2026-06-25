<?php

namespace App\Policies;

use App\Models\Breed;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BreedPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Breed $breed): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Breed $breed): bool
    {
    }

    public function delete(User $user, Breed $breed): bool
    {
    }

    public function restore(User $user, Breed $breed): bool
    {
    }

    public function forceDelete(User $user, Breed $breed): bool
    {
    }
}
