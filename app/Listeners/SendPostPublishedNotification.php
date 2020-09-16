<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Models\User;
use App\Traits\UserCollectionForMailing;
use Illuminate\Support\Facades\Notification;

class SendPostPublishedNotification
{
    use UserCollectionForMailing;

    /**
     * Уведомляет админов и автора о публикации поста
     *
     * @param PostPublished $event
     * @return void
     */
    public function handle(PostPublished $event)
    {
        $users = User::admins()->get();

        $this->addToUsersIfNotExists($users, $event->post->user);

        Notification::send($users, new \App\Notifications\PostPublished($event->post));
    }
}
