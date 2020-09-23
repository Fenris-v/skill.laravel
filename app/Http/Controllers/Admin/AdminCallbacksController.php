<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Callback;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class AdminCallbacksController extends Controller
{
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
