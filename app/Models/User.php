<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Устанавливаем в качестве дефолтного ключа name
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * Создаем связь "многие ко многим"
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * Проверяет является ли текущий пользователь админом
     * @param int $userId
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->groups()->where('id', Group::ADMIN_ID)->exists();
    }

    /**
     * Все посты пользователя
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Выбирает всех админов
     * @param $query
     * @return mixed
     */
    public function scopeAdmins($query)
    {
        return $query->whereHas(
            'groups',
            function ($query) {
                $query->where('id', Group::ADMIN_ID);
            }
        );
    }
}
