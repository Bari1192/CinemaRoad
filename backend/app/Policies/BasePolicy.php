<?php

namespace App\Policies;

use App\Models\User;

class BasePolicy
{
    public function isAdmin(User $user)
    {
        return "admin" == $user->role;
    }
}
