<?php

use Illuminate\Database\Seeder;
use App\SubChapter;

class SubChaptersTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'subscribe_ru' => '',
                'head_ru' => 'Сервис',
                'head_en' => 'Service',
                'content_ru' =>
                    '<h2>Сервисный центр Endosphere Therapy® в Москве.</h2>
                    <p>ООО «ЛПУ-Сервис» (ИНН7726689496)
                    <br>Адрес: 117587, г. Москва, Варшавское шоссе, дом 125 стр. 1<br>
                    Телефон/факс:<a href="tel:+74959792445">+7 495 979-24-45</a><br>
                    E-mail:<a href="mailto:lpu-s@rambler.ru">lpu-s@rambler.ru</a><br>
                    Лицензия на на обслуживание медицинской техники № 99-03-003057 от 01.08.2012</p>
                    <h3>Горячая линия технической поддержки по оборудованию Endosphere Therapy®:</h3>
                    <h3><a href="tel:+79262097816">+7 926 209-78-16</a></h3>
                    <p>(Пн–Пт: 9-00-19-00)</p>
                    <br>
                    <p>только для обслуживания и ремонта оборудования!</p>',
                'chapter_id' => 7,
            ],
            [
                'subscribe_ru' => '',
                'head_ru' => 'Обучение',
                'head_en' => 'Training',
                'content_ru' =>
                    '<h2>Учебный центр Endosphere Therapy® в Москве</h2>
                    <h3>Услуги центра</h3>
                    <p>Консультации для обученных эстетистов, докторов;<br>
                    Обучение при приобретении оборудования;<br>
                    Проведение показов и презентаций оборудования;</p>
                    <br>
                    <h3>ТЕЛЕФОН ДЛЯ ЗАПИСИ</h3>
                    <h3><a href="tel:+79161640436">+7 916 164-04-36</a></h3>
                    <br>
                    <p>Врачи центра: </p>
                    <h3>Корнейчук Оксана -</h3>
                    <p>сертифицированный тренер фирмы-производителя Fenix Group Italia</p>',
                'chapter_id' => 7,
            ],
            [
                'subscribe_ru' => 'Эндосфера не нуждается в рекламе оплаченных сомнительных блогеров. Наша реклама - это владельцы Эндосферы - самые лучшие и известные клиники и салоны России',
                'slide' => 'results.jpg',
                'head_ru' => 'Отзывы',
                'head_en' => 'Reviews',
                'content_ru' => '',
                'chapter_id' => 5,
            ],
            [
                'subscribe_ru' => '',
                'head_ru' => 'Фото до и после',
                'head_en' => 'Photo before and after',
                'content_ru' => '',
                'chapter_id' => 5,
            ],
            [
                'slide' => 'mass-media1.jpg',
                'subscribe_ru' => 'Анастасия Волочкова, Ирена Понарошку, Алена Бородина, Леся Ярославская, Ирина Дубцова, Полина Аскери, Маша Малиновская, Мишаня, Виктория Боня и другие звезды рекомендуют Endospheres Therapy®',
                'head_ru' => 'Печатные СМИ',
                'head_en' => 'Print mass-media',
                'content_ru' => '',
                'have_a_mm' => true,
                'chapter_id' => 8,
            ],
            [
                'slide' => 'mass-media2.jpg',
                'subscribe_ru' => 'Анастасия Волочкова, Ирена Понарошку, Алена Бородина, Леся Ярославская, Ирина Дубцова, Полина Аскери, Маша Малиновская, Мишаня, Виктория Боня и другие звезды рекомендуют Endospheres Therapy®',
                'head_ru' => 'Интернет-издания',
                'head_en' => 'internet',
                'content_ru' => '',
                'have_a_resources' => true,
                'chapter_id' => 8,
            ],
            [
                'slide' => 'mass-media3.jpg',
                'subscribe_ru' => 'Анастасия Волочкова, Ирена Понарошку, Алена Бородина, Леся Ярославская, Ирина Дубцова, Полина Аскери, Маша Малиновская, Мишаня, Виктория Боня и другие звезды рекомендуют Endospheres Therapy®',
                'head_ru' => 'TV-реклама',
                'head_en' => 'tv',
                'content_ru' => '',
                'have_a_resources' => true,
                'chapter_id' => 8,
            ],
        ];

        foreach ($data as $item) {
            SubChapter::create($item);
        }
    }
}