<?php

namespace App\Policies;

use App\Models\Realty\Realty;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RealtyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function edit(User $user, Realty $advertisement) {
        return $user->id == $advertisement->author_id;
    }

}
