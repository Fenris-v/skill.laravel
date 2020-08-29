<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'anatolijv236@gmail.com',
                'password' => '$2y$10$AHIg2LBWiSlu7jrHakquqO6XIg4btsAXET41quUTFaoxsmPwBXuKe' // 'password'
            ]
        );

        DB::statement('ALTER TABLE users ALTER COLUMN id SET DEFAULT (2);');
    }
}
