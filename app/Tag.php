<?php

namespace App;

use App\Traits\GenerateSlug;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use GenerateSlug;

    protected $fillable = ['name', 'slug'];

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
     * Посты по тегу
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * Возвращает коллекцию тегов для облака
     * @return mixed
     */
    public static function tagsCloud()
    {
        return (new static)->has('posts')->get();
    }
}
