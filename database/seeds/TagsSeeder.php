<?php

use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'История'],
            ['id' => 2, 'name' => 'Литература']
        ];

        foreach ($items as $item) {
            Tag::create($item);
        }

        DB::statement('ALTER TABLE tags ALTER COLUMN id SET DEFAULT (3);');
    }
}
