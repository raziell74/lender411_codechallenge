<?php

namespace App\Providers;

use Laravel\Passport\Passport;
Passport::tokensCan([
    'add-team' => 'Add Team',
    'update-team' => 'Update Team',
    'delete-team' => 'Delete Team',
    'add-player' => 'Add Player',
    'update-player' => 'Update Player',
    'delete-player' => 'Delete Player',
    'get-team-players' => 'Get Team and Team Players'
]);
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
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
    }
}
