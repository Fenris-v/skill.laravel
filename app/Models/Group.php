<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    const ADMIN_ID = 1;

    protected $fillable = ['name'];

    /**
     * Создаем связь "многие ко многим"
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeAdmins($query)
    {
        return $query->where('id', self::ADMIN_ID);
    }
}
