<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @return mixed
     */
    public function view()
    {
        return Auth::user()->isAdmin()
            ? Response::allow()
            : Response::deny('test');
    }
}
