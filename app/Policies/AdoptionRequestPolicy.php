<?php

namespace App\Policies;

use App\Models\AdoptionRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdoptionRequestPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, AdoptionRequest $adoptionRequest): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, AdoptionRequest $adoptionRequest): bool
    {
    }

    public function delete(User $user, AdoptionRequest $adoptionRequest): bool
    {
    }

    public function restore(User $user, AdoptionRequest $adoptionRequest): bool
    {
    }

    public function forceDelete(User $user, AdoptionRequest $adoptionRequest): bool
    {
    }
}
