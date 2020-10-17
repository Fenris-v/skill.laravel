<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostEdited implements ShouldBroadcast
{
    use Dispatchable, SerializesModels, InteractsWithSockets;

    public string $broadcastQueue = 'ws-notification';

    public Post $post;
    public array $updatedFields;

    /**
     * Create a new event instance.
     *
     * @param Post $post
     * @param array $updatedFields
     */
    public function __construct(Post $post, array $updatedFields)
    {
        $this->post = $post;
        $this->updatedFields = $updatedFields;
    }

    /**
     * Уведомление для админа
     *
     * @return Channel|Channel[]|void
     */
    public function broadcastOn()
    {
        return new PrivateChannel('post');
    }

    /**
     * Пробрасывает переменные в веб сокет
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'title' => $this->post->title ?? '',
            'slug' => route('posts.show', $this->post->slug),
            'fields' => $this->updatedFields
        ];
    }
}
