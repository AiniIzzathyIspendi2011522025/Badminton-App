<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('thisAdmin', function($user){
            return $user->thisAdmin();
        });
        Gate::define('thisOwner', function($user){
            return $user->thisOwner();
        });
        Gate::define('thisCustomer', function($user){
            return $user->thisCustomer();
        });
    }
}
