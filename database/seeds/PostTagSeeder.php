<?php

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
            $keyTags = array_rand($tagsId, rand(1, 4));

            $keyTags = is_array($keyTags) ? $keyTags : [$keyTags];

            foreach ($keyTags as $key) {
                $post->tags()->attach($tagsId[$key]);
            }
        }
    }
}
