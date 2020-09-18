<?php

namespace App\Models;

use App\Events\PostCreated;
use App\Events\PostEdited;
use App\Events\PostRemoved;
use App\Events\PostUnpublished;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Spatie\Sluggable\HasSlug;

use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasSlug;

    protected $dispatchesEvents = [
        'created' => PostCreated::class,
        'deleted' => PostRemoved::class
    ];

    /** Разрешенные для массового заполнения поля */
    protected $fillable = ['title', 'slug', 'short_desc', 'text', 'published', 'user_id'];

    protected static function boot()
    {
        parent::boot();

        /** Собственная логика на событие 'updated' */
        static::updated(
            function ($post) {
                $updatedFields = collect($post->getDirty())->forget('updated_at');

                if ($updatedFields->count() > 1 || !$updatedFields->keys()->contains('published')) {
                    event(new PostEdited($post));
                } elseif ($updatedFields->get('published') === false) {
                    event(new PostUnpublished($post));
                } elseif ($updatedFields->get('published') === 'on') {
                    event(new PostEdited($post));
                }
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
     * Добавляет возможность делать выборки по полю published = 1
     * @param $query
     * @return mixed
     */
    public function scopePublishedPosts($query)
    {
        return $query->where('published', 1);
    }

    /**
     * Добавляет возможность делать выборки по полю published = 0
     * @param $query
     * @return mixed
     */
    public function scopeUnpublishedPosts($query)
    {
        return $query->where('published', 0);
    }

    /**
     * Автор статьи
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Публикация поста
     * @param bool $publishing
     */
    public function publishing($publishing = true)
    {
        $this->update(['published' => $publishing]);
    }

    /**
     * Снятие поста с публикации
     */
    public function unpublishing()
    {
        $this->publishing(false);
    }

    /**
     * Теги поста
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Изменяет теги поста
     * @param Post $post
     */
    public function syncTags(Post $post)
    {
        $tags = collect(request('tags'))->keyBy(
            function ($item) {
                return $item;
            }
        );

        $syncIds = [];

        foreach ($tags as $tag) {
            $tagObj = Tag::where('name', $tag)->first();

            if (!$tagObj) {
                $tagObj = Tag::create(['name' => $tag]);
            }

            $syncIds[] = $tagObj->id;
        }

        $post->tags()->sync($syncIds);
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
}
