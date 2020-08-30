<?php

namespace App\Providers;

use App\Policies\PostPolicy;
use App\Post;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param Gate $gate
     * @return void
     */
    public function boot(Gate $gate)
    {
        $gate->before(
            function ($user) {
                if ($user::isAdmin()) {
                    return true;
                }
                return null;
            }
        );

        $this->registerPolicies();
    }
}
