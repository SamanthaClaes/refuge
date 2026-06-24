<?php

namespace App\Policies;

use App\Models\Animal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnimalPolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Animal $animal): bool
    {
        return $user->role === 'admin';
    }
}
