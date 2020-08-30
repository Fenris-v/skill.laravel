<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @return mixed
     */
    // TODO: странно, что этот метод просто возвращает true, т.к. мне нужно проверить только на админа,
    // TODO: а это я делаю через Gate в AuthServiceProvider::class
    public function viewAny()
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Post $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return $post->user_id === $user->id;
    }
}
