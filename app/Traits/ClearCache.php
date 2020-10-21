<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

/**
 * Трейт для очистки кэша на событие модели
 * @package App\Traits
 */
trait ClearCache
{
    public static function bootClearCache()
    {
        static::created(
            function ($item) {
                Cache::tags($item->getTags())->flush();
            }
        );

        static::updated(
            function ($item) {
                Cache::tags($item->getTags())->flush();
            }
        );

        static::deleted(
            function ($item) {
                Cache::tags($item->getTags())->flush();
            }
        );
    }
}
