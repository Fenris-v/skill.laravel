<?php

use App\Group;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'Админ'],
            ['id' => 2, 'name' => 'Пользователь']
        ];

        foreach ($items as $item) {
            Group::create($item);
        }

        DB::statement('ALTER TABLE groups ALTER COLUMN id SET DEFAULT (3);');
    }
}
