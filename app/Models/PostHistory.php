<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostHistory extends Model
{
    protected $fillable = ['before', 'after'];

    /**
     * Преобразует данные к массиву
     * @var string[]
     */
    protected $casts = [
        'before' => 'array',
        'after' => 'array',
    ];

    /**
     * Связь с пользователем
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Связь с постом
     * @return BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
