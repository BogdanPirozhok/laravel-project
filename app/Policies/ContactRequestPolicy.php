<?php

namespace App\Policies;

use App\Models\ContactRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactRequestPolicy
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

    public function viewList(User $user): bool
    {
        return $user->can('manage contact requests');
    }

    /**
     * @param User $user
     * @param ContactRequest $model
     * @return bool
     */
    public function view(User $user, ContactRequest $model): bool
    {
        return $user->can('manage contact requests');
    }

    /**
     * @param User $user
     * @param ContactRequest $model
     * @return bool
     */
    public function delete(User $user, ContactRequest $model): bool
    {
        return $user->can('manage contact requests');

    }
}
