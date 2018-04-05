<?php

namespace App\Providers;

use Laravel\Passport\Passport;
Passport::tokensCan([
    'add-teams' => 'Add Team',
    'delete-teams' => 'Delete Team',
    'add-player' => 'Add Player',
    'update-player' => 'Update Player',
    'delete-player' => 'Delete Player',
    'view-teams' => 'View Team and Team Players'
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
