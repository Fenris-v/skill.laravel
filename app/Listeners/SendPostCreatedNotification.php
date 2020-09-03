<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Group;
use Illuminate\Support\Facades\Notification;

class SendPostCreatedNotification
{
    /**
     * Уведомляет админов и автора о создании нового поста
     *
     * @param  PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $users = Group::with('users')->admins()->first()->users;

        $users[] = $event->post->user;

        Notification::send($users, new \App\Notifications\PostCreated($event->post));
    }
}
