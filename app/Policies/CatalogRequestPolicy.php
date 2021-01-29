<?php

namespace App\Policies;

use App\Models\CatalogRequest;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CatalogRequestPolicy
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
        return $user->can('manage catalog requests');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user): bool
    {
        return $user->can('manage catalog requests');
    }

    /**
     * @param User $user
     * @param CatalogRequest $model
     * @return bool
     */
    public function delete(User $user, CatalogRequest $model): bool
    {
        return $user->can('manage catalog requests');
    }
}
