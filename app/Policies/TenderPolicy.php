<?php

namespace App\Policies;

use App\Models\Tender;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenderPolicy
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
        return $user->can('manage tender');
    }

    /**
     * @param User|null $user
     * @param Tender $tender
     * @return bool
     */
    public function view(User $user, Tender $tender): bool
    {
        return $user->can('manage tender');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user): bool
    {
        return $user->can('manage tender');
    }

    /**
     * @param User $user
     * @param Tender $tender
     * @return bool
     */
    public function delete(User $user, Tender $tender): bool
    {
        return $user->can('manage tender');
    }
}
