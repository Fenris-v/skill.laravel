<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            ['name' => 'История', 'slug' => Str::slug('История')],
            ['name' => 'Литература', 'slug' => Str::slug('Литература')]
        ];

        foreach ($items as $item) {
            Tag::create($item);
        }
    }
}
