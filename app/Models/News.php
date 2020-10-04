<?php

namespace App\Models;

use App\Traits\HasComments;
use App\Traits\HasTag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class News extends Model
{
    use HasFactory;
    use HasSlug;
    use SoftDeletes;
    use HasTag;
    use HasComments;

    protected $fillable = ['title', 'slug', 'short_desc', 'text'];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Создает slug
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * Изменяет теги поста
     * @param News $news
     */
    public function syncTags(News $news)
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

        $news->tags()->sync($syncIds);
    }
}
