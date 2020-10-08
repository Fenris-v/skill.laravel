<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentForm;
use App\Models\News;
use App\Models\Post;
use App\Service\SaveComment;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    private SaveComment $saveComment;

    public function __construct(SaveComment $saveComment)
    {
        $this->saveComment = $saveComment;
    }

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

        $this->saveComment->saveComment($post, $validate);

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

        $this->saveComment->saveComment($news, $validate);

        return back();
    }
}
