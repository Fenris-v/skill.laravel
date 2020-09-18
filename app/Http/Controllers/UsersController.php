<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends Controller
{
    /**
     * Вывод всех статей пользователя
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(User $user)
    {
        $posts = $user->posts()->publishedPosts()->latest()->with('user')->get();

        return view('main.index', compact('posts'));
    }
}
