<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentForm;
use App\Models\Comment;
use App\Models\News;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    /**
     * Добавляет комментарий к посту
     *
     * @param Post $post
     * @param CommentForm $request
     * @return RedirectResponse
     */
    public function postStore(Post $post, CommentForm $request)
    {
        $validate = $request->validated();

        $validate['user_id'] = auth()->id();

        $post->comments()->save(new Comment($validate));

        return back();
    }

    /**
     * Добавляет комментарий к новости
     *
     * @param News $news
     * @param CommentForm $request
     * @return RedirectResponse
     */
    public function newsStore(News $news, CommentForm $request)
    {
        $validate = $request->validated();

        $validate['user_id'] = auth()->id();

        $news->comments()->save(new Comment($validate));

        return back();
    }
}
