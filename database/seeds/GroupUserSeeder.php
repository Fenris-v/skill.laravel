<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['user_id' => 1, 'group_id' => 2],
            ['user_id' => 2, 'group_id' => 2]
        ];

        foreach ($items as $item) {
            DB::table('group_user')->insert($item);
        }
    }
}
