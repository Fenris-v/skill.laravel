<?php

namespace App\Models;

use App\Events\ClearCacheEvent;
use App\Interfaces\Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model implements Cache
{
    use HasFactory;

    protected $fillable = ['text', 'user_id'];

    /** События */
    protected $dispatchesEvents = [
        'created' => ClearCacheEvent::class,
        'updated' => ClearCacheEvent::class,
        'deleted' => ClearCacheEvent::class
    ];

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

    public function getTags(): array
    {
        return ['comments'];
    }
}
