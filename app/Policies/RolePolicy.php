<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Spatie\Permission\Models\Role;

class RolePolicy
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
        return $user->can('manage roles');
    }

    public function view(User $user, Role $role): bool
    {
        return $user->can('manage roles');
    }

    /**
     * @param User $user
     * @param Role $role
     * @return bool
     */
    public function assignPermission(User $user, Role $role): bool
    {
        if($role->essential === true) {
            return false;
        } else {
            return $user->can('manage roles');
        }
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('manage roles');
    }

    /**
     * @param User $user
     * @param Role $role
     * @return bool
     */
    public function update(User $user, Role $role): bool
    {
        if($role->essential === true) {
            return false;
        } else {
            return $user->can('manage roles');
        }
    }

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user, Role $role): bool
    {
        if($role->essential === true) {
            return false;
        } else {
            return $user->can('manage roles');
        }
    }

}
