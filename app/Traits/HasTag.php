<?php

namespace App\Traits;

use App\Models\Tag;

trait HasTag
{
    /**
     * Привязка тегов к посту
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
