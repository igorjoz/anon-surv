<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\CompletedSurvey;
use App\Models\Question;
use App\Models\Survey;
use App\Policies\QuestionPolicy;
use App\Policies\SurveyPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Survey::class => SurveyPolicy::class,
        Question::class => QuestionPolicy::class,
        CompletedSurvey::class => CompletedSurvey::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
