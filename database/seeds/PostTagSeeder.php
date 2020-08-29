<?php

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
        $items = [
            ['post_id' => 1, 'tag_id' => 1],
            ['post_id' => 2, 'tag_id' => 1],
            ['post_id' => 2, 'tag_id' => 2]
        ];

        foreach ($items as $item) {
            DB::table('post_tag')->insert($item);
        }
    }
}
