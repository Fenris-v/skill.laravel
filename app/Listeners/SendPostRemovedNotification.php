<?php

namespace App\Listeners;

use App\Events\PostRemoved;
use App\Models\Group;
use App\Models\User;
use App\Traits\UserCollectionForMailing;
use Illuminate\Support\Facades\Notification;

class SendPostRemovedNotification
{
    use UserCollectionForMailing;

    /**
     * Уведомляет админов и автора об удалении поста
     *
     * @param PostRemoved $event
     * @return void
     */
    public function handle(PostRemoved $event)
    {
        $users = User::admins()->get();

        $this->addToUsersIfNotExists($users, $event->post->user);

        Notification::send($users, new \App\Notifications\PostRemoved($event->post));
    }
}
