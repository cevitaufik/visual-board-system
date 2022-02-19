<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
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
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-all-users', [UserPolicy::class, 'viewAny']);
        Gate::define('create-users', [UserPolicy::class, 'create']);
        Gate::define('update-users', [UserPolicy::class, 'update']);
        Gate::define('delete-users', [UserPolicy::class, 'delete']);
    }
}
