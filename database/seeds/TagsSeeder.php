<?php

use App\Tag;
use Illuminate\Database\Seeder;

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
            ['name' => 'История'],
            ['name' => 'Литература']
        ];

        foreach ($items as $item) {
            Tag::create($item);
        }
    }
}
