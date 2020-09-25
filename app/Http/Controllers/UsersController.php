<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class UsersController extends Controller
{
    /**
     * Вывод всех статей пользователя
     * @param User $user
     * @return Application|Factory|View
     */
    public function index(User $user)
    {
        $posts = $user->posts()->publishedPosts()->latest()->with('user')->get();

        return view('main.index', compact('posts'));
    }
}
