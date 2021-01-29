<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use function Symfony\Component\String\u;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('manage users');
    }


    /**
     * Determine if user can assing roles
     * @param User $user
     * @return bool
     */
    public function assignRole(User $user)
    {
        return $user->can('manage roles');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param  User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return $user->can('manage users');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('manage users');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param  User  $model
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        return $user->can('manage users') || $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param  User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->can('manage users');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param  User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param  User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
