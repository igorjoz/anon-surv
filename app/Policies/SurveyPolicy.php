<?php

namespace App\Policies;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SurveyPolicy
{
    use HandlesAuthorization;

    public function createCompletedSurvey(User $user, Survey $survey)
    {
        return $survey->is_published;
    }

    public function storeCompletedSurvey(User $user, Survey $survey)
    {
        return $survey->is_published;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Survey $survey)
    {
        return $user->id == $survey->user_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Survey $survey)
    {
        return $user->id == $survey->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Survey $survey)
    {
        return $user->id == $survey->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Survey $survey)
    {
        return $user->id == $survey->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Survey $survey)
    {
        return $user->id == $survey->user_id;
    }
}
