<?php

namespace App\Traits;

use Cache;

trait ClearCache
{
    private function clearPostsTags()
    {
        Cache::tags(['blog', 'posts', 'tags'])->flush();
    }

    private function clearNewsTags()
    {
        Cache::tags(['blog', 'news', 'tags'])->flush();
    }

    private function clearPostsNewsTags()
    {
        Cache::tags(['blog', 'posts', 'news', 'tags'])->flush();
    }

    private function clearComments(string $relation, int $id)
    {
        Cache::tags(['blog', 'comments_' . $relation . '_' . $id])->flush();
    }
}
