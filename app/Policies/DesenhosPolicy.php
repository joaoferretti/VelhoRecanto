<?php

namespace App\Policies;

use App\Models\Desenhos;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DesenhosPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Desenhos $desenhos): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    public function update(User $user, Desenhos $desenho)
    {
        return $user->id === $desenho->user_id;
    }

    public function delete(User $user, Desenhos $desenho)
    {
        return $user->id === $desenho->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Desenhos $desenhos): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Desenhos $desenhos): bool
    {
        return false;
    }
}
