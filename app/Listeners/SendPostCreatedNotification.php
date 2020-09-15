<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

class SendPostCreatedNotification
{
    /**
     * Уведомляет админов и автора о изменении поста
     *
     * @param PostCreated $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $users = User::whereHas(
            'groups',
            function ($query) {
                $query->where('id', Group::ADMIN_ID);
            }
        )->get();

        // TODO: Есть ли какое-то более изящное решение, чем это?
        // TODO: Вынес в /app/helpers.php, чтобы избежать дублирования в других классах уведомлений.
        // TODO: Задавал этот вопрос в одном из первых сообщений,
        // TODO: но к сожалению он потерялся и остался без ответа
        addToUsersIfNotExists($users, $event->post->user);

        Notification::send($users, new \App\Notifications\PostCreated($event->post));
    }
}
