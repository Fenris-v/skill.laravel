<?php

namespace App\Models;

use App\Interfaces\Cache;
use App\Traits\ClearCache;
use App\Traits\HasComments;
use App\Traits\HasTag;
use App\Traits\SyncTags;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class News extends Model implements Cache
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;
    use HasTag;
    use HasComments;
    use SyncTags;
    use ClearCache;

    protected $fillable = ['title', 'slug', 'short_desc', 'text'];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Создает slug
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * Возвращает теги для кэша
     * @return array
     */
    public function getTags(): array
    {
        return ['news', 'tags', 'comments_news_' . $this->id];
    }
}
