<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @return bool
     */
    public function view()
    {
        // TODO: Что-то я так и не понял почему данная политика у меня не заработала.
        // TODO: Пробовал разные варианты, в том числе в аргументах метода указывал User $user, как в документации
        // TODO: В контроллере вызывал таким образом
        /** $this->authorize('view'); */
        // TODO: В ответ всегда получал 403.
        // TODO: Хотя думаю, что в данном случае middleware лучше подойдет, т.к. применяю сразу на весь контроллер
        return Auth::user()->isAdmin();
    }
}
