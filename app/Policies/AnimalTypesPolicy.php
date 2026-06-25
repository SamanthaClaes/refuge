<?php

namespace App\Policies;

use App\Models\AnimalTypes;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnimalTypesPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, AnimalTypes $animalTypes): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, AnimalTypes $animalTypes): bool
    {
    }

    public function delete(User $user, AnimalTypes $animalTypes): bool
    {
    }

    public function restore(User $user, AnimalTypes $animalTypes): bool
    {
    }

    public function forceDelete(User $user, AnimalTypes $animalTypes): bool
    {
    }
}
