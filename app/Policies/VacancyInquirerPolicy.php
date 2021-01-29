<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VacancyInquirer;
use Illuminate\Auth\Access\HandlesAuthorization;

class VacancyInquirerPolicy
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
     * @param User $user
     * @return bool
     */
    public function viewList(User $user): bool
    {
        return $user->can('manage vacancy inquirers');

    }

    /**
     * @param User $user
     * @param VacancyInquirer $inquirer
     * @return bool
     */
    public function view(User $user, VacancyInquirer $inquirer): bool
    {
        return $user->can('manage vacancy inquirers');
    }

    /**
     * @param User $user
     * @param VacancyInquirer $inquirer
     * @return bool
     */
    public function delete(User $user, VacancyInquirer $inquirer): bool
    {
        return $user->can('manage vacancy inquirers');
    }
}
