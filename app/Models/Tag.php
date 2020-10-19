<?php

namespace App\Models;

use App\Traits\ClearCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Tag extends Model
{
    use HasFactory;
    use HasSlug;
    use ClearCache;

    protected $fillable = ['name', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::created(
            function () {
                $this->clearPostsNewsTags();
            }
        );

        static::updated(
            function () {
                $this->clearPostsNewsTags();
            }
        );

        static::deleted(
            function () {
                $this->clearPostsNewsTags();
            }
        );
    }

    /**
     * Переопределяем по какому значению будет поиск по БД для маршрута
     * Если это primary key, то переопределять не нужно
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Привязка постов к тегам
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    /**
     * Привязка новостей к тегам
     */
    public function news()
    {
        return $this->morphedByMany(News::class, 'taggable');
    }

    /**
     * Возвращает коллекцию тегов для облака
     * @return mixed
     */
    public static function tagsCloud()
    {
        return (new static)->has('posts')->orWhereHas('news')->get();
    }

    /**
     * Создает slug
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
