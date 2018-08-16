<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['email' => 'info.endospheres@gmail.com','password' => bcrypt('endospheresinfo')],
            ['email' => 'romis.nesmelov@gmail.com','password' => bcrypt('apg192')]
        ];

        foreach ($data as $user) {
            User::create($user);
        }
    }
}