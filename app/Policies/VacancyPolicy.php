<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Auth\Access\HandlesAuthorization;

class VacancyPolicy
{
    use HandlesAuthorization;


    /**
     * @param User|null $user
     * @param Vacancy $vacancy
     * @return bool
     */
    public function view(?User $user, Vacancy $vacancy): bool
    {
        return $vacancy->is_published || optional($user)->can('manage vacancy');
    }

    public function viewList(User $user): bool
    {
        return $user->can('manage vacancy');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user): bool
    {
        return $user->can('manage vacancy');
    }

    /**
     * @param User $user
     * @param Vacancy $vacancy
     */
    public function delete(User $user, Vacancy $vacancy): bool
    {
        return $user->can('manage vacancy');
    }
}
