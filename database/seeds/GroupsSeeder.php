<?php

use App\Group;
use Illuminate\Database\Seeder;

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
            ['name' => 'Админ'],
            ['name' => 'Пользователь']
        ];

        foreach ($items as $item) {
            Group::create($item);
        }
    }
}
