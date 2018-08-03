<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create(['email' => 'info.endospheres@gmail.com','password' => bcrypt('endospheresinfo')]);
    }
}