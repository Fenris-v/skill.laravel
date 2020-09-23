<?php

namespace App\Providers;

use App\Models\Tag;
use Auth;
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

        // TODO: Я правильно понимаю, что теперь при помощи Blade::component
        // TODO: создается что-то вроде хелпера для рендера? Оставил закомментированным для вопроса, потом удалю
//        Blade::component('components.alert', 'alert');
        Blade::aliasComponent('components.alert', 'alert');

        // TODO: Что-то я совсем не понял смысла подобных директив
        // TODO: Проверка выполняется один раз после view:clear
        // TODO: Затем директива возвращает только одно значение, которое видимо где-то кэшированным остается
        // TODO: И сама запись как-то сложно выглядит, кажется, что проще хелпер сделать или что-то подобное
        Blade::directive(
            'editPost',
            function ($expression) {
                if (Auth::check() && Auth::user()->isAdmin()) {
                    return "<?php echo route('admin.posts.edit', ['post' => $expression]) ?>";
                } else {
                    return "<?php echo route('posts.edit', ['post' => $expression]) ?>";
                }
            }
        );
    }
}
