<?php

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                DB::table('post_tag')->insert(
                    [
                        'post_id' => $post->id,
                        'tag_id' => $tagsId[$key]
                    ]
                );
            }
        }
    }
}
