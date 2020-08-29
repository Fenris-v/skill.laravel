<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** Разрешенные для массового заполнения поля */
    protected $fillable = ['title', 'slug', 'short_desc', 'text', 'published'];

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
    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }
}
