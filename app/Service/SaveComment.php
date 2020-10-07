<?php

namespace App\Service;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

class SaveComment
{
    /**
     * Сохраняет комментарий в БД
     *
     * @param Model $item
     * @param array $data
     */
    public function saveComment(Model $item, array $data): void
    {
        $data['user_id'] = auth()->id();

        $item->comments()->save(new Comment($data));
    }
}
