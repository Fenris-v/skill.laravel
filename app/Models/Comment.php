<?php

namespace App\Models;

use App\Traits\ClearCache;
use Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;
    use ClearCache;

    protected $fillable = ['text', 'user_id'];

    protected static function boot()
    {
        parent::boot();

        static::created(
            function () {
                Cache::tags(['blog', 'comments'])->flush();
            }
        );

        static::updated(
            function () {
                Cache::tags(['blog', 'comments'])->flush();
            }
        );

        static::deleted(
            function () {
                Cache::tags(['blog', 'comments'])->flush();
            }
        );
    }

    /**
     * Привязка к другим моделям
     * @return MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Привязка к пользователю
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
