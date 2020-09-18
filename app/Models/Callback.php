<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
    /** Разрешенные для массового заполнения поля */
    protected $fillable = ['email', 'message'];

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
