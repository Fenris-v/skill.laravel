<?php

use App\Providers\PushAllServiceProvider;
use App\Service\Pushall;
use GuzzleHttp\Exception\GuzzleException;

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
     * @throws GuzzleException
     */
    function pushall($title = null, $text = null)
    {
        if (is_null($title) || is_null($text)) {
            return app(Pushall::class);
        }

        if (mb_strlen($title) > PushAllServiceProvider::MAX_TITLE_LENGTH) {
            $title = mb_strimwidth($title, 0, PushAllServiceProvider::MAX_TITLE_LENGTH - 3, '...');
        }

        if (mb_strlen($text) > PushAllServiceProvider::MAX_TEXT_LENGTH) {
            $text = mb_strimwidth($text, 0, PushAllServiceProvider::MAX_TEXT_LENGTH - 3, '...');
        }

        return app(Pushall::class)->send($title, $text);
    }
}
