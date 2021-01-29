<?php

namespace App\Policies;

use App\Models\QualityFeedback;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QualityPolicy
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
        return $user->can('manage review');
    }

    /**
     * @param User $user
     * @param QualityFeedback $qualityFeedback
     * @return bool
     */
    public function view(User $user, QualityFeedback $qualityFeedback): bool
    {
        return $user->can('manage review');
    }

    /**
     * @param User $user
     * @param QualityFeedback $qualityFeedback
     * @return bool
     */
    public function delete(User $user, QualityFeedback $qualityFeedback): bool
    {
        return $user->can('manage review');
    }
}
