<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Политика, которая отвечает за то, чтобы только автор или админ мог редактировать пост.
     *
     * @param User $user
     * @param Post $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return $post->user_id === $user->id || $user::isAdmin();
    }

    /**
     * Политика отвечающая за то, чтобы только админ мог просматривать неопубликованные посты.
     *
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function showPost(User $user, Post $post)
    {
        return $user::isAdmin() || $post->published;
    }
}
