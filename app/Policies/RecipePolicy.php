<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecipePolicy
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
     * Check if user can view recipe
     *
     * @param User|null $user
     * @param Recipe $recipe
     * @return bool
     */
    public function view(?User $user, Recipe $recipe)
    {
        return $recipe->is_published || optional($user)->can('manage recipe');
    }


    /**
     * Define if user can inspect recipes in admin page
     *
     * @param User $user
     * @return bool
     */
    public function inspect(User $user)
    {
        return $user->can('manage recipe');
    }

    /**
     * Check if user can create recipe
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->can('manage recipe');
    }

    /**
     * Check if user can edit recipe
     *
     * @param User $user
     * @param Recipe $recipe
     * @return bool
     */
    public function edit(User $user, Recipe $recipe)
    {
        return $user->can('manage recipe');
    }

    /**
     * @param User $user
     * @param Recipe $recipe
     * @return bool
     */
    public function publish(User $user, Recipe $recipe)
    {
        return $user->can('manage recipe');
    }

    /**
     * @param User $user
     * @param Recipe $recipe
     * @return bool
     */
    public function delete(User $user, Recipe $recipe)
    {
        return $user->can('manage recipe');
    }
}
