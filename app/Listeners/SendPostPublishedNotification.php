<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Group;
use Illuminate\Support\Facades\Notification;

class SendPostPublishedNotification
{
    /**
     * Уведомляет админов и автора о публикации поста
     *
     * @param PostPublished $event
     * @return void
     */
    public function handle(PostPublished $event)
    {
        $users = Group::with('users')->admins()->first()->users;

        $users[] = $event->post->user;

        Notification::send($users, new \App\Notifications\PostPublished($event->post));
    }
}
