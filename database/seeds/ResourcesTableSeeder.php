<?php

use Illuminate\Database\Seeder;
use App\Resource;

class ResourcesTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'logo' => '/resources_logos/allure.jpg',
                'url' => 'http://www.yandex.ru',
                'description_ru' => 'Дорогое удовольствие (Хабаровск)',
                'sub_chapter_id' => 6
            ],
            [
                'logo' => '/resources_logos/cosmopolitan.jpg',
                'url' => 'http://www.yandex.ru',
                'description_ru' => 'Путь к стройности: лучшие процедуры для тела',
                'sub_chapter_id' => 6
            ],
            [
                'logo' => '/resources_logos/glamour.jpg',
                'url' => 'http://www.yandex.ru',
                'description_ru' => 'Дорогое удовольствие (Хабаровск)',
                'sub_chapter_id' => 6
            ],
            [
                'logo' => '/resources_logos/granzia.jpg',
                'url' => 'http://www.yandex.ru',
                'description_ru' => 'То, чего нет под микроскопом',
                'sub_chapter_id' => 6
            ],
            [
                'logo' => '/resources_logos/marie_claire.jpg',
                'url' => 'http://www.yandex.ru',
                'description_ru' => 'То, чего нет под микроскопом',
                'sub_chapter_id' => 6
            ],
            [
                'logo' => '',
                'url' => '<iframe id="jcemediabox-popup-iframe" frameborder="0" allowtransparency="true" scrolling="auto" width="100%" height="300" src="http://www.youtube.com/embed/A4UZJpzkPDw?wmode=opaque"></iframe>',
                'description_ru' => 'Рекламная компания Endospheres Therapy на Канале 5 (Canale Cinque) в Италии',
                'sub_chapter_id' => 7
            ],
        ];

        foreach ($data as $item) {
            Resource::create($item);
        }
    }
}