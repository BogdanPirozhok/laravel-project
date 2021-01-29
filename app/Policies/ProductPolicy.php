<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use App\Repositories\Category\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
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


    public function view(?User $user, Product $product)
    {
        return $product->is_published || optional($user)->can('manage product');
    }

    public function create(User $user)
    {
        return $user->can('manage product');
    }

    public function edit(User $user, Product $product)
    {
        return $user->can('manage product');
    }

    public function delete(User $user, Product $product)
    {
        return $user->can('manage product');
    }
}
