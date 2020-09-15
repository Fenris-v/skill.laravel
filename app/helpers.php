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

    /**
     * Принимает коллекцию и пользователя, проверяет есть ли пользователь в коллекции,
     * если его нет, то добавляет и возвращает итоговую коллекцию
     *
     * @param $usersCollection
     * @param $user
     * @return mixed
     */
    function addToUsersIfNotExists($usersCollection, $user) {
        if (!in_array($user->email, $usersCollection->pluck('email')->toArray())) {
            $usersCollection[] = $user;
        }
        return $usersCollection;
    }
}
