<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
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

    protected $appends = [
        'admin'
    ];

    /**
     * Роутинг для slack
     * @param $notification
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function routeNotificationForSlack($notification)
    {
        return config('app.slack_link');
    }

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
     * @return BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * Создает вычисляемое поле admin
     * @param $value
     * @return mixed
     */
    public function getAdminAttribute($value)
    {
        return $value;
    }

    /**
     * Проверяет является ли текущий пользователь админом
     * @return bool
     */
    public function isAdmin(): bool
    {
        if ($this->admin === null) {
            $this->admin = $this->groups()->where('id', Group::ADMIN_ID)->exists();
        }

        return $this->admin;
    }

    /**
     * Все посты пользователя
     * @return HasMany
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

    /**
     * Привязка к комментариям
     * @return BelongsToMany
     */
    public function comments()
    {
        return $this->belongsToMany(Comment::class);
    }
}
