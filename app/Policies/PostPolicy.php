<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use App\Repositories\Category\Interfaces\CategorizedInterface;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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

    public function view(?User $user, Post $post): bool
    {
        return $post->is_published || optional($user)->can('manage post');
    }

    public function viewList(User $user): bool
    {
        return $user->can('manage post');
    }

    public function save(User $user): bool
    {
        return $user->can('manage post');
    }

    public function publish(User $user, Post $post): bool
    {
        return $user->can('manage post');
    }

    public function feature(User $user, Post $post): bool
    {
        return $user->can('manage post');
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->can('manage post');
    }
}
