<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'anatolijv236@gmail.com',
                'password' => '$2y$10$AHIg2LBWiSlu7jrHakquqO6XIg4btsAXET41quUTFaoxsmPwBXuKe' // 'password'
            ],
            [
                'name' => 'Just User',
                'email' => 'test@gmail.com',
                'password' => '$2y$10$AHIg2LBWiSlu7jrHakquqO6XIg4btsAXET41quUTFaoxsmPwBXuKe' // 'password'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
