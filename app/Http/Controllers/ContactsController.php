<?php

namespace App\Http\Controllers;

use App\Models\Callback;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ContactsController extends Controller
{
    /**
     * Возвращает отображение страницы контактов
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('contacts.index');
    }

    /**
     * Сохраняет заявку
     * @return Application|RedirectResponse|Redirector
     * @throws ValidationException
     */
    public function store()
    {
        $request = $this->validate(request(), [
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Callback::create($request);

        return redirect('/');
    }
}
