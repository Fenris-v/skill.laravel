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
                $item->cacheFlush($item);
            }
        );

        static::updated(
            function ($item) {
                $item->cacheFlush($item);
            }
        );

        static::deleted(
            function ($item) {
                $item->cacheFlush($item);
            }
        );
    }

    private function cacheFlush($item): void
    {
        Cache::tags($item->getTags())->flush();
    }
}
