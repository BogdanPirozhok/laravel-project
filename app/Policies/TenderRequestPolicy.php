<?php

namespace App\Policies;

use App\Models\TenderRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenderRequestPolicy
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
        return $user->can('manage tender requests');
    }

    /**
     * @param User $user
     * @param TenderRequest $tender
     * @return bool
     */
    public function view(User $user, TenderRequest $tender): bool
    {
        return $user->can('manage tender requests');
    }

    /**
     * @param User $user
     * @param TenderRequest $tender
     * @return bool
     */
    public function delete(User $user, TenderRequest $tender): bool
    {
        return $user->can('manage tender requests');
    }
}
