<?php

namespace App\Policies;

use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

    public function edit(User $user, User $edit_user) {
        return $user->id == $edit_user->id;
    }

    public function auth(User $user) {
        return true;
    }
}
