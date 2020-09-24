<?php

namespace App\Providers;

use App\Service\Pushall;
use Illuminate\Support\ServiceProvider;

class PushAllServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Pushall::class, function () {
            return new Pushall(config('services.pushall.key'), config('services.pushall.id'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
