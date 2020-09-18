<?php

namespace App\Listeners;

use App\Events\PostUnpublished;
use App\Models\Group;
use App\Models\User;
use App\Traits\UserCollectionForMailing;
use Illuminate\Support\Facades\Notification;

class SendPostUnpublishedNotification
{
    use UserCollectionForMailing;

    /**
     * Уведомляет админов и автора о снятии поста с публикации
     *
     * @param PostUnpublished $event
     * @return void
     */
    public function handle(PostUnpublished $event)
    {
        $users = User::admins()->get();

        $this->addToUsersIfNotExists($users, $event->post->user);

        Notification::send($users, new \App\Notifications\PostUnpublished($event->post));
    }
}
