<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if user can wee unpublished pages
     * @param User|null $user
     * @param Page $page
     * @return bool
     */
    public function view(?User $user, Page $page)
    {
        return $page->is_published || optional($user)->can('manage pages');
    }

    /**
     * Determine if user can create pages
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->can('manage pages');
    }

    /**
     * Determine if user can edit pages
     *
     * @param User $user
     * @param Page $page
     * @return bool
     */
    public function edit(User $user, Page $page)
    {
        return $user->can('manage pages');
    }

    /**
     * Determine if user can delete pages
     *
     * @param User $user
     * @param Page $page
     * @return bool
     */
    public function delete(User $user, Page $page)
    {
        return $user->can('manage pages');
    }
}
