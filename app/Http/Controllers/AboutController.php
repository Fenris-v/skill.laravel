<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    /**
     * Станица для админа, где выводятся все заявки
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('about.index');
    }
}
