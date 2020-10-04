<?php

use App\Models\News;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagsId = [];
        foreach (Tag::all() as $tag) {
            $tagsId[] = $tag->id;
        }

        foreach (Post::all() as $post) {
            $keyTags = $this->getRandomTags($tagsId);

            foreach ($keyTags as $key) {
                $post->tags()->attach($tagsId[$key]);
            }
        }

        foreach (News::all() as $news) {
            $keyTags = $this->getRandomTags($tagsId);

            foreach ($keyTags as $key) {
                $news->tags()->attach($tagsId[$key]);
            }
        }
    }

    private function getRandomTags($tagsId): array
    {
        $keyTags = array_rand($tagsId, rand(1, 4));

        return is_array($keyTags) ? $keyTags : [$keyTags];
    }
}
