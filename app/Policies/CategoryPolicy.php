<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Repositories\Category\Models\Category;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * @param User|null $user
     * @param Category $category
     * @return bool
     */
    public function view(?User $user, Category $category)
    {
        return $category->is_published || optional($user)->can('manage category');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->can('manage category');
    }

    public function edit(User $user, Category $category)
    {
        return $user->can('manage category');
    }

    public function delete(User $user, Category $category)
    {
        return $user->can('manage category');
    }

    public function publish(User $user, Category $category)
    {
        return $user->can('manage category');
    }

    public function appendCategory(User $user, Category $category)
    {
        return $user->can('manage category');
    }
}
