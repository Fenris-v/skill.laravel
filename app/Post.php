<?php

namespace App;

use App\Events\PostCreated;
use App\Events\PostEdited;
use App\Events\PostPublished;
use App\Events\PostRemoved;
use App\Events\PostUnpublished;
use App\Traits\GenerateSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use function route;

class Post extends Model
{
    use GenerateSlug;

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
                if (
                    url()->current() === route('postPublishing', $post->slug) &&
                    strtoupper(request()->method()) === 'POST'
                ) {
                    event(new PostPublished($post));
                } elseif (
                    url()->current() === route('postPublishing', $post->slug) &&
                    strtoupper(request()->method()) === 'DELETE'
                ) {
                    event(new PostUnpublished($post));
                } else {
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
}
