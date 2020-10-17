<?php

namespace App\Listeners;

use App\Events\PostEdited;
use App\Models\Group;
use App\Models\User;
use App\Traits\UserCollectionForMailing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Notification;

class SendPostEditedNotification implements ShouldQueue
{
    use UserCollectionForMailing;

    public string $queue = 'notifications';

    /**
     * Уведомляет админов и автора о создании нового поста
     *
     * @param PostEdited $event
     * @return void
     */
    public function handle(PostEdited $event)
    {
        $users = User::admins()->get();

        $this->addToUsersIfNotExists($users, $event->post->user);

        Notification::send($users, new \App\Notifications\PostEdited($event->post));
    }
}
