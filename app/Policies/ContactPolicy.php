<?php

namespace App\Policies;

use App\Models\Contact;
use App\Models\User;

class ContactPolicy
{
    /**
     * Create a new policy instance.
     */
    public function mainCheck(User $user, $contact): bool
    {
        return $contact->from_user_id === $user->id or $contact->to_user_id === $user->id;
    }
}
