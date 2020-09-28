<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class AboutController extends Controller
{
    /**
     * Станица для админа, где выводятся все заявки
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('about.index');
    }
}
