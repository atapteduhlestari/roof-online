<?php

namespace App\Policies;

use App\Models\TrnMaintenance;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrnMaintenancePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->is_admin === 1;
    }

    public function view(User $user, TrnMaintenance $trnMaintenance)
    {
        return $trnMaintenance->sbu_id == $user->sbu_id && $user->is_admin === 1 ? Response::allow()
            : Response::deny('You do not have access');
    }

    public function update(User $user, TrnMaintenance $trnMaintenance)
    {
        return $trnMaintenance->sbu_id == $user->sbu_id || $user->is_admin === 1 ? Response::allow()
            : Response::deny('You do not have access');
    }

    public function delete(User $user, TrnMaintenance $trnMaintenance)
    {
        return $trnMaintenance->sbu_id == $user->sbu_id || $user->is_admin === 1 ? Response::allow()
            : Response::deny('You do not have access');
    }
}
