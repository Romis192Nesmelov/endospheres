<?php

use Illuminate\Database\Seeder;
use App\Slide;

class SlidesTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'path' => '/video/video1',
                'poster' => '/video/video1.jpg',
                'head_ru' => '',
                'head_en' => '',
                'description_ru' => '',
                'description_en' => '',
                'background_color' => 'rgb(99,173,223)',
                'mouse_color' => 'rgb(255,255,255)',
                'is_image' => false,
                'active' => true
            ],
            [
                'path' => '/video/video2',
                'poster' => '/video/video2.jpg',
                'head_ru' => '',
                'head_en' => '',
                'description_ru' => '',
                'description_en' => '',
                'background_color' => 'rgb(0,0,0)',
                'mouse_color' => 'rgb(255,255,255)',
                'is_image' => false,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide3.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => 'это оригинальная методика, созданная в Италии в 2007 году и не имеющая аналогов. Метод компрессионной микровибрации® зарегистрирован в 2007 году и принадлежит компании FenixSr (Италия). Оборудование производится на фабрике компании Fenix в Италии',
                'description_en' => '',
                'background_color' => 'rgb(255,255,255)',
                'mouse_color' => 'rgb(255,255,255)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide4.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => 'это флагман рынка коррекции фигуры и решения проблем целлюлита и флебологии',
                'description_en' => '',
                'background_color' => 'rgb(99,173,223)',
                'mouse_color' => 'rgb(255,255,255)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide5.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => 'это, прежде всего, научная методика, эффективность которой подтверждена клиническими испытаниями в лучших университетских клиниках Европы, а так же имеющая Регистрационное удостоверение Росздравнадзора Российской Федерации',
                'description_en' => '',
                'background_color' => 'rgb(54,86,152)',
                'mouse_color' => 'rgb(0,66,119)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide6.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => 'не инвазивна, безопасна, безболезненна, максимально физиологочна, практически не имеет противопоказания и не требует реабилитации',
                'description_en' => '',
                'background_color' => 'rgb(189,178,212)',
                'mouse_color' => 'rgb(12,17,49)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide7.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => 'это первые аппараты в мире, которые умеют «чувствовать» Ваше тело. Особая система Sensor имеет патент и позволяет правильно подобрать мощность воздействия и режим процедуры индивидуально для каждого пациента',
                'description_en' => '',
                'background_color' => 'rgb(129,178,215)',
                'mouse_color' => 'rgb(255,255,255)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide8.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => 'популярна и востребована в лучших клиниках и салонах России и многих стран мира',
                'description_en' => '',
                'background_color' => 'rgb(128,61,0)',
                'mouse_color' => 'rgb(255,255,255)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide9.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => 'это инвестиция в Ваше здоровье',
                'description_en' => '',
                'background_color' => 'rgb(0,57,140)',
                'mouse_color' => 'rgb(255,255,255)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide10.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => 'это надежная инвестиция в Ваш бизнес',
                'description_en' => '',
                'background_color' => 'rgb(64,150,108)',
                'mouse_color' => 'rgb(19,36,45)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide11.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => 'это аппараты для тела и лица класса «Люкс», которые олицетворяют собой мечту, к которой стремятся все. Это методика для «гурманов» рынка эстетической медицины',
                'description_en' => '',
                'background_color' => 'rgb(254,205,136)',
                'mouse_color' => 'rgb(255,255,255)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide12.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => 'это методика, которая буквально захватила весь мир!',
                'description_en' => '',
                'background_color' => 'rgb(0,126,99)',
                'mouse_color' => 'rgb(255,255,255)',
                'is_image' => true,
                'active' => true
            ],
        ];

        foreach ($data as $item) {
            Slide::create($item);
        }
    }
}