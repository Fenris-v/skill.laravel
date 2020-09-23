<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class PostCreated extends Notification
{
    use Queueable;

    public Post $post;

    /**
     * Create a new notification instance.
     *
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            'mail',
            'slack'
        ];
    }

    /**
     * Уведомление в слак
     * @param $notifiable
     * @return SlackMessage
     */
    // TODO: Прошу прокомментировать интеграцию со слак.
    // TODO: Сделал, т.к. было интересно и на работе уже был подробный запрос, но не в рамках фреймворков.
    // TODO: Роутинг для слака в модели User, как в документации.
    // TODO: Код работает, но может какие-то рекомендации будут
    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->content('На сайте создан новый пост <' . route('posts.show', $this->post->slug)
                      . '|' . $this->post->title . '>');
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->replyTo($notifiable->email)->markdown('mail.post-created', ['post' => $this->post]);
    }
}
