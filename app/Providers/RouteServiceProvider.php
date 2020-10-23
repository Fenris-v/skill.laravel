<?php

namespace App\Providers;

use App\Models\Post;
use Closure;
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
                return $this->cacheModel(
                    ['news', 'news_' . $slug],
                    'news_' . $slug,
                    function () use ($slug) {
                        return Post::where('slug', $slug)->first();
                    }
                );
            }
        );

        Route::bind(
            'post',
            function ($slug) {
                return $this->cacheModel(
                    ['posts', 'posts_' . $slug],
                    'posts_' . $slug,
                    function () use ($slug) {
                        return Post::where('slug', $slug)->first();
                    }
                );
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
     * @param $tags
     * @param $id
     * @param Closure $callback
     * @param int $time
     * @return array|mixed
     */
    protected function cacheModel($tags, $id, Closure $callback, $time = 86400)
    {
        return Cache::tags($tags)->remember($id, $time, $callback);
    }
}
