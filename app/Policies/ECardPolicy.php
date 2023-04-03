<?php

namespace App\Policies;

use App\Models\ECard;
use App\Models\User;

class ECardPolicy
{
    /**
     * Determine if the given e-card can be seen by the user.
     */
    public function create(User $user, ECard $eCard): bool
    {
        return $user->id === $eCard->user_id;
    }

    /**
     * Determine if the given e-card can be updated by the user.
     */
    public function update(User $user, ECard $eCard): bool
    {
        return $user->id === $eCard->user_id;
    }

    /**
     * Determine if the given e-card can be deleted by the user.
     */
    public function delete(User $user, ECard $eCard): bool
    {
        return $user->id === $eCard->user_id;
    }
}
