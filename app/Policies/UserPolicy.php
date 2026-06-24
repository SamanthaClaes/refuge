<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, User $model): bool
    {
    }

    public function restore(User $user, User $model): bool
    {
    }

    public function forceDelete(User $user, User $model): bool
    {
    }
}
