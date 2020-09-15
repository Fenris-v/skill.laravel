<?php

namespace App\Listeners;

use App\Events\PostUnpublished;
use App\Models\Group;
use Illuminate\Support\Facades\Notification;

class SendPostUnpublishedNotification
{
    /**
     * Уведомляет админов и автора о снятии поста с публикации
     *
     * @param PostUnpublished $event
     * @return void
     */
    public function handle(PostUnpublished $event)
    {
        $users = Group::with('users')->admins()->first()->users;

        addToUsersIfNotExists($users, $event->post->user);

        Notification::send($users, new \App\Notifications\PostUnpublished($event->post));
    }
}
