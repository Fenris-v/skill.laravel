<?php

namespace App\Models;

use App\Events\PostCreated;
use App\Events\PostEdited;
use App\Events\PostPublished;
use App\Events\PostRemoved;
use App\Events\PostUnpublished;
use App\Interfaces\Cache;
use App\Traits\ClearCache;
use App\Traits\HasComments;
use App\Traits\HasTag;
use App\Traits\SyncTags;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model implements Cache
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;
    use HasTag;
    use HasComments;
    use SyncTags;
    use ClearCache;

    /** События */
    protected $dispatchesEvents = [
        'created' => PostCreated::class,
        'deleted' => PostRemoved::class
    ];

    /** Разрешенные для массового заполнения поля */
    protected $fillable = ['title', 'slug', 'short_desc', 'text', 'published', 'user_id'];

    /** Дополнительные поля для метода toArray() */
    protected $appends = [
        'text_length'
    ];

    /** Преобразовать значение к типу */
    protected $casts = [
        'published' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        /** Собственная логика на событие 'updated' */
        static::updated(
            function ($post) {
                $updatedFields = collect($post->getDirty())->forget('updated_at');

                if ($updatedFields->count() > 1 || !$updatedFields->keys()->contains('published')) {
                    event(new PostEdited($post, array_keys($updatedFields->toArray())));
                } elseif ($updatedFields->get('published') === false) {
                    event(new PostUnpublished($post));
                } elseif ($updatedFields->get('published') === 'on') {
                    event(new PostPublished($post));
                }
            }
        );

        static::updating(
            function (Post $post) {
                $after = $post->getDirty();
                $post->history()->attach(
                    auth()->id(),
                    [
                        'before' => Arr::only($post->fresh()->toArray(), array_keys($after)),
                        'after' => $after
                    ]
                );
            }
        );
    }

    /**
     * Возвращает теги для кэша
     * @return array
     */
    public function getTags(): array
    {
        return ['posts', 'tags', 'comments_posts_' . $this->id];
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
     * Посты за последнюю неделю
     * @param $query
     * @return mixed
     */
    public function scopeWeeklyPosts($query)
    {
        return $query->where('created_at', '>', Carbon::now()->subWeek());
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
     * Длина статьи
     * @return false|int
     */
    public function getTextLengthAttribute()
    {
        return mb_strlen($this->text);
    }

    /**
     * Связь с историей
     * @return BelongsToMany
     */
    public function history()
    {
        return $this->belongsToMany(User::class, 'post_histories')
            ->withPivot(['after', 'before'])->using(HistoryPivot::class)->withTimestamps();
    }
}
