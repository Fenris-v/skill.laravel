<?php

namespace App\Models;

use App\Interfaces\Cache;
use App\Traits\ClearCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model implements Cache
{
    use HasFactory;
    use ClearCache;

    protected $fillable = ['text', 'user_id'];

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

    /**
     * Возвращает теги для кэша
     * @return array
     */
    public function getTags(): array
    {
        return ['comments'];
    }
}
