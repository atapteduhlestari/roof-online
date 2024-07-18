<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TrnRenewal;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrnRenewalPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->is_admin === 1;
    }

    public function view(User $user, TrnRenewal $trnRenewal)
    {
        return $trnRenewal->sbu_id == $user->sbu_id || $user->is_admin === 1 ? Response::allow()
            : Response::deny('You do not have access');
    }

    public function update(User $user, TrnRenewal $trnRenewal)
    {
        return $trnRenewal->sbu_id == $user->sbu_id || $user->is_admin === 1 ? Response::allow()
            : Response::deny('You do not have access');
    }

    public function delete(User $user, TrnRenewal $trnRenewal)
    {
        return $trnRenewal->sbu_id == $user->sbu_id || $user->is_admin === 1 ? Response::allow()
            : Response::deny('You do not have access');
    }
}
