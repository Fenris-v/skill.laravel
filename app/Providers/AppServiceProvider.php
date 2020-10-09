<?php

namespace App\Providers;

use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        view()->composer(
            'layout.side',
            function (View $view) {
                $view->with('tagsCloud', Tag::tagsCloud());
            }
        );

        view()->composer(
            'posts.edit-tags',
            function (View $view) {
                $view->with('tags', Tag::all());
            }
        );

        Blade::aliasComponent('components.alert', 'alert');

        /** Директива, которая перенаправляет админа на редактирование статьи в админке */
        Blade::directive(
            'editPost',
            function ($expression) {
                return "<?= route(Auth::check() && Auth::user()->is_admin ? 'admin.posts.edit' : 'posts.edit', ['post' => $expression]); ?>";
            }
        );

        Paginator::defaultView('pagination::bootstrap-4');
    }
}
