<?php

namespace App\Listeners;

use App\Events\PostEdited;
use App\Models\Group;
use Illuminate\Support\Facades\Notification;

class SendPostEditedNotification
{
    /**
     * Уведомляет админов и автора о создании нового поста
     *
     * @param PostEdited $event
     * @return void
     */
    public function handle(PostEdited $event)
    {
        $users = Group::with('users')->admins()->first()->users;

        $users[] = $event->post->user;

        Notification::send($users, new \App\Notifications\PostEdited($event->post));
    }
}
