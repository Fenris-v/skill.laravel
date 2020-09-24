<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\View\View;

class AdminUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin.panel');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users', compact('users'));
    }

    public function show(Group $group)
    {
        $users = $group->users()->with('groups')->get();

        return view('admin.users', compact('users'));
    }
}
