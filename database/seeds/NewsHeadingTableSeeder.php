<?php

use Illuminate\Database\Seeder;
use App\NewsHeading;

class NewsHeadingTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['slide' => 'news_heading1.jpg','head_ru' => 'Новости от представительства','subscribe_ru' => 'Компания «ИталКонсалт» – единственный и эксклюзивный представитель Endospheres Therapy в России, странах СНГ и на Балканах Все другие предложения покупки оборудования Endospheres (Эндосфера) являются незаконными.'],
            ['slide' => 'news_heading2.jpg','head_ru' => 'Новости от производителя','subscribe_ru' => 'EndoSphères Thèrapy®, Microvibrazione Compressiva®, Ak55®, AkBody®, SR Face®, AkSensor®, AkSensor ALL®, логотип Fenix Group - это марки, созданные и запатентованные компанией Fenix Snc.'],
            ['slide' => 'news_heading3.jpg','head_ru' => 'Новости эстетической медицины','subscribe_ru' => ''],
            ['slide' => 'news_heading4.jpg','head_ru' => 'Магия Эндосферы','subscribe_ru' => 'Короткие рассказы и советы для красивых женщин'],
        ];

        foreach ($data as $item) {
            NewsHeading::create($item);
        }
    }
}