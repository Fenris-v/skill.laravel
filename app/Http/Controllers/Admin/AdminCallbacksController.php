<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Callback;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class AdminCallbacksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin.panel');
    }

    /**
     * Станица для админа, где выводятся все заявки
     * @return Application|Factory|View
     */
    public function index()
    {
        $callbacks = Callback::latest()->get();

        return view('admin.callbacks', compact('callbacks'));
    }
}
