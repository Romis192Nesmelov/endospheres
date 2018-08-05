<?php

use Illuminate\Database\Seeder;
use App\Slide;

class SlidesTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'path' => '/video/video1.mp4',
                'poster' => '/video/video.jpg',
                'head_ru' => '',
                'head_en' => '',
                'description_ru' => 'Вся правда о ...',
                'description_en' => '',
                'background' => 'rgba(255,255,255)',
                'is_image' => false,
                'active' => true
            ],
            [
                'path' => '/video/video2.mp4',
                'poster' => '/video/video.jpg',
                'head_ru' => '',
                'head_en' => '',
                'description_ru' => 'Вся правда о ...',
                'description_en' => '',
                'background' => 'rgba(255,255,255)',
                'is_image' => false,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide1.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => 'rgba(255,255,255)',
                'description_ru' => '<p>– это оригинальная методика, созданная в Италии в 2007 году и не имеющая аналогов.<br>Метод компрессионной микровибрации® зарегистрирован в 2007 году и принадлежит компании FenixSr (Италия). Оборудование производится на фабрике компании Fenix в Италии.</p>',
                'description_en' => '',
                'background' => '',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide2.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => '<p>– это флагман рынка коррекции фигуры и решения проблем целлюлита и флебологии.</p>',
                'description_en' => '',
                'background' => 'rgba(99,173,223)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide3.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => '<p>– это, прежде всего, научная методика, эффективность которой подтверждена клиническими испытаниями в лучших университетских клиниках Европы, а так-же имеющая Регистрационное удостоверение Росздравнадзора Российской Федерации.</p>',
                'description_en' => '',
                'background' => 'rgba(189,178,212)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide4.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => '<p>– не инвазивна, безопасна, безболезненна, максимально физиологочна, практически не имеет противопоказания и не требует реабилитации.</p>',
                'description_en' => '',
                'background' => 'rgba(54,86,152)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide5.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => '<p>– это первые аппараты в мире, которые умеют «чувствовать» Ваше тело. Особая система Sensor имеет патент и позволяет правильно подобрать мощность воздействия и режим процедуры индивидуально для каждого пациента.</p>',
                'description_en' => '',
                'background' => 'rgba(129,178,215)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide6.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => '<p>– популярна и востребована в лучших клиниках и салонах России и многих стран мира.</p>',
                'description_en' => '',
                'background' => 'rgba(128,61,0)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide7.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => '<p>– это инвестиция в Ваше здоровье.</p>',
                'description_en' => '',
                'background' => 'rgba(0,57,140)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide8.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => '– это надежная инвестиция в Ваш бизнес.',
                'description_en' => '',
                'background' => 'rgba(64,150,108)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide9.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => '– это аппараты для тела и лица класса «Люкс», которые олицетворяют собой мечту, к которой стремятся все. Это методика для «гурманов» рынка эстетической медицины.',
                'description_en' => '',
                'background' => 'rgba(254,205,136)',
                'is_image' => true,
                'active' => true
            ],
            [
                'path' => '/images/landing/slide10.jpg',
                'poster' => '',
                'head_ru' => 'Эндосфера терапия®',
                'head_en' => '',
                'description_ru' => '– это методика, которая буквально захватила весь мир!',
                'description_en' => '',
                'background' => 'rgba(0,126,99)',
                'is_image' => true,
                'active' => true
            ],
        ];

        foreach ($data as $item) {
            Slide::create($item);
        }
    }
}