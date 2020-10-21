<?php

namespace App\Providers;

use App\Models\News;
use App\Models\Post;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
//    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Route::bind(
            'news',
            function ($slug) {
                return $this->getModel($slug, 'news');
            }
        );

        Route::bind(
            'post',
            function ($slug) {
                return $this->getModel($slug, 'posts');
            }
        );
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    /**
     * Возвращает коллекцию модели из кэша
     * @param string $slug
     * @param string $model
     * @return array|mixed
     */
    private function getModel(string $slug, string $model)
    {
        return Cache::tags([$model, $model . '_' . $slug])->remember(
            $model . '_' . $slug,
            3600 * 24,
            function () use ($slug, $model) {
                // TODO: Я хотел написать DB::table($model)->...
                // TODO: Но получал ошибку PDO, поэтому решил цикл написать, но теперь это выглядит не очень хорошо
                switch ($model) {
                    case 'news':
                        return News::where('slug', $slug)->first();
                    case 'posts':
                        return Post::where('slug', $slug)->first();
                }
            }
        );
    }
}
