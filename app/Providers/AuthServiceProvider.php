<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\AdminPolicy;
use App\Policies\PostPolicy;
use App\Models\Post;
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
        Post::class => PostPolicy::class,
        // TODO: А каким образом правильно регистрировать политику без модели?
//        User::class => AdminPolicy::class
//        AdminPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param Gate $gate
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
