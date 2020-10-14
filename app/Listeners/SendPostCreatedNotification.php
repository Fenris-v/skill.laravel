<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Models\User;
use App\Traits\UserCollectionForMailing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendPostCreatedNotification implements ShouldQueue
{
    use UserCollectionForMailing;

    public string $queue = 'notifications';

    /**
     * Уведомляет админов и автора о изменении поста
     *
     * @param PostCreated $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $users = User::admins()->get();

        $this->addToUsersIfNotExists($users, $event->post->user);

        Notification::send($users, new \App\Notifications\PostCreated($event->post));

        pushall($event->post->title, $event->post->short_desc);
    }
}
