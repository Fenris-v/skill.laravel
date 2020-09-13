<?php

namespace App\Http\Controllers;

use App\Models\Callback;

class ContactsController extends Controller
{
    /**
     * Станица для админа, где выводятся все заявки
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $callbacks = Callback::latest()->get();

        return view('contacts.admin', compact('callbacks'));
    }

    /**
     * Возвращает отображение страницы контактов
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('contacts.index');
    }

    /**
     * Сохраняет заявку
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
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
