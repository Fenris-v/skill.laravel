<?php

namespace App\Providers;

use App\Models\Tag;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layout.side', function (View $view) {
            $view->with('tagsCloud', Tag::tagsCloud());
        });

        view()->composer('posts.edit-tags', function (View $view) {
            $view->with('tags', Tag::all());
        });
    }
}
