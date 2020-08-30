<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    /**
     * Добавляет возможность делать выборки по полю published = 0
     * @param $query
     * @return mixed
     */
    public function scopeUnpublished($query)
    {
        return $query->where('published', 0);
    }

    /**
     * Генерирует url,
     * проверяет его на уникальность и дописывает номера,
     * пока url не станет уникальным
     *
     * @param string $str
     * @return string
     */
    public function generateSlug(string $str): string
    {
        $slug = Str::slug($str);

        if ($this::all()->where('slug', $slug)->first()) {
            $i = 2;
            while ($this::all()->where('slug', $slug . $i)->first()) {
                $i++;
            }

            $slug .= $i;
        }

        return $slug;
    }
}
