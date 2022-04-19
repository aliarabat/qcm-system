<?php

namespace App\Providers;

use App\Question;
use App\User;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Question' => 'App\Policies\QuestionPolicy',
        'App\Niveau' => 'App\Policies\MainPartPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('show-eveluations', fn (User $user) => in_array($user->role->name, ['PROFESSOR', 'STUDENT']));
        Gate::define('show-qcm', fn (User $user) => in_array($user->role->name, ['MANAGER', 'PROFESSOR']));
    }
}
