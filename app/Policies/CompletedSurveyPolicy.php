<?php

namespace App\Policies;

use App\Models\CompletedSurvey;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompletedSurveyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompletedSurvey  $completedSurvey
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, CompletedSurvey $completedSurvey)
    {
        return $completedSurvey->survey->is_published;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompletedSurvey  $completedSurvey
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, CompletedSurvey $completedSurvey)
    {
        return $user->id == $completedSurvey->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CompletedSurvey  $completedSurvey
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, CompletedSurvey $completedSurvey)
    {
        return $user->id == $completedSurvey->user_id;
    }
}
