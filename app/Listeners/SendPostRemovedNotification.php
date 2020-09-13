<?php

namespace App\Listeners;

use App\Events\PostRemoved;
use App\Models\Group;
use Illuminate\Support\Facades\Notification;

class SendPostRemovedNotification
{
    /**
     * Уведомляет админов и автора об удалении поста
     *
     * @param PostRemoved $event
     * @return void
     */
    public function handle(PostRemoved $event)
    {
        $users = Group::with('users')->admins()->first()->users;

        $users[] = $event->post->user;

        Notification::send($users, new \App\Notifications\PostRemoved($event->post));
    }
}
