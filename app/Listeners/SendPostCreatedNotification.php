<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Models\User;
use App\Traits\UserCollectionForMailing;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Notification;

class SendPostCreatedNotification
{
    use UserCollectionForMailing;

    /**
     * Уведомляет админов и автора о изменении поста
     *
     * @param PostCreated $event
     * @return void
     * @throws GuzzleException
     */
    public function handle(PostCreated $event)
    {
        $users = User::admins()->get();

        $this->addToUsersIfNotExists($users, $event->post->user);

        Notification::send($users, new \App\Notifications\PostCreated($event->post));

        pushall($event->post->title, $event->post->shrot_desc);
    }
}
