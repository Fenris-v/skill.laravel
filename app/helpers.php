<?php

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
