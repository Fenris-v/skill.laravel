<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin.panel');
    }

    /**
     * Рабочий стол
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Пользователи
     *
     * @return Application|Factory|View
     */
    public function users()
    {
        return view('admin.users');
    }
}
