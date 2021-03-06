<?php

namespace App\Providers;

use App\Staff;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('create-resource', function (User $user) {
            return $user->is_admin;
        });

        Gate::define('update-resource', function (User $user) {
            return $user->is_admin;
        });

        Gate::define('update-staff', function (User $user, Staff $staff) {
            return $user->is_admin || $user->id == $staff->id;
        });
    }
}
