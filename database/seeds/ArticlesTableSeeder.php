<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        for($i=0;$i<34;$i++) {
            Article::create([
                'head' => 'Знакомьтесь Endospheres Therapy – Эндосфера терапия – компрессионная микровибрация в борьбе с целлюлитом и возрастными изменениями кожи',
                'content' => '<p>'.str_random(50).'</p>',
                'active' => 1
            ]);
        }
    }
}