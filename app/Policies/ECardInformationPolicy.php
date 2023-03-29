<?php

namespace App\Policies;

use App\Models\ECardInformation;
use App\Models\User;

class ECardInformationPolicy
{
    /**
     * Determine if the given e-card information can be seen by the user.
     */
    public function create(User $user, ECardInformation $eCardInformation): bool
    {
        return $user->id === $eCardInformation->eCard->user_id;
    }

    /**
     * Determine if the given e-card information can be seen by the user.
     */
    public function update(User $user, ECardInformation $eCardInformation): bool
    {
        return $user->id === $eCardInformation->eCard->user_id;
    }
}
