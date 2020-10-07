<?php


namespace App\Traits;


use App\Models\News;
use App\Models\Tag;

trait SyncTags
{
    /**
     * Изменяет теги поста
     * @param News $news
     */
    public function syncTags($post)
    {
        $tags = collect(request('tags'))->keyBy(
            function ($item) {
                return $item;
            }
        );

        $syncIds = [];

        foreach ($tags as $tag) {
            $tagObj = Tag::where('name', $tag)->first();

            if (!$tagObj) {
                $tagObj = Tag::create(['name' => $tag]);
            }

            $syncIds[] = $tagObj->id;
        }

        $post->tags()->sync($syncIds);
    }
}
