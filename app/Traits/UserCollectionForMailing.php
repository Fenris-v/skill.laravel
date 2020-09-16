<?php


namespace App\Traits;


trait UserCollectionForMailing
{
    /**
     * Принимает коллекцию и пользователя, проверяет есть ли пользователь в коллекции,
     * если его нет, то добавляет и возвращает итоговую коллекцию
     *
     * @param $usersCollection
     * @param $user
     * @return mixed
     */
    private function addToUsersIfNotExists($usersCollection, $user) {
        if (!in_array($user->email, $usersCollection->pluck('email')->toArray())) {
            $usersCollection[] = $user;
        }
        return $usersCollection;
    }
}
