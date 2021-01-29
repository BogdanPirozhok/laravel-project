<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PointPolicy
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
    public function csv(User $user): bool
    {
        return $user->can('manage map');
    }
}
