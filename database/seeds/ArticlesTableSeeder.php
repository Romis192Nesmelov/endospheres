<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        for($i=0;$i<34;$i++) {
            Article::create([
                'head' => str_random(20),
                'content' => '<p>'.str_random(50).'</p>',
                'active' => 1
            ]);
        }
    }
}