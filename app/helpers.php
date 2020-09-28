<?php

use App\Service\Pushall;

if (!function_exists('flash')) {
    /**
     * Добавляет в сессию сообщение с уведомлением на 1 переход
     * @param $message
     * @param string $type
     */
    function flash($message, $type = 'success')
    {
        session()->flash('message', $message);
        session()->flash('message_type', $type);
    }
}

if (!function_exists('pushall')) {
    /**
     * Push уведомления
     * @param null $title
     * @param null $text
     * @return Pushall|mixed
     */
    function pushall($title = null, $text = null)
    {
        if (is_null($title) || is_null($text)) {
            return app(Pushall::class);
        }

        return app(Pushall::class)->send($title, $text);
    }
}
