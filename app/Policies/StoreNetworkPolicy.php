<?php

namespace App\Policies;

use App\Models\StoreNetwork;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoreNetworkPolicy
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

    /**
     * @param User $user
     * @return bool
     */
    public function viewList(User $user): bool
    {
        return $user->can('manage map');
    }

    /**
     * @param User $user
     * @param StoreNetwork $network
     * @return bool
     */
    public function view(User $user, StoreNetwork $network): bool
    {
        return $user->can('manage map');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user): bool
    {
        return $user->can('manage map');
    }

    /**
     * @param User $user
     * @param StoreNetwork $network
     * @return bool
     */
    public function delete(User $user, StoreNetwork $network): bool
    {
        return $user->can('manage map');
    }
}
