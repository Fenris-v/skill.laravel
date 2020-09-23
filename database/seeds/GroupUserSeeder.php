<?php

use App\Models\User;
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
        foreach (User::all() as $user) {
            DB::table('group_user')
                ->insert(
                    [
                        'user_id' => $user->id,
                        'group_id' => 2
                    ]
                );
        }
    }
}
