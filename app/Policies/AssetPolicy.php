<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Asset;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssetPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->is_admin === 1;
    }

    public function update(User $user, Asset $asset)
    {
        return $asset->sbu_id == $user->sbu_id || $user->is_admin === 1 ? Response::allow()
            : Response::deny('You do not have access');
    }

    public function delete(User $user, Asset $asset)
    {
        return $asset->sbu_id == $user->sbu_id || $user->is_admin === 1 ? Response::allow()
            : Response::deny('You do not have access');
    }
}
