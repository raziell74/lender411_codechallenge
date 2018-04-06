<?php

namespace App\Providers;

use Laravel\Passport\Passport;
Passport::tokensCan([
    'view-teams' => 'View Team(s)',
    'view-players' => 'View Player(s)',
    'add-teams' => 'Add Teams',
    'add-players' => 'Add Players',
    'update-players' => 'Update Players',
    'delete-teams' => 'Delete Teams',
    'delete-players' => 'Delete Players'
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
