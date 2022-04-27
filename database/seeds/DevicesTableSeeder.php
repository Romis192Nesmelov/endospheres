<?php

use Illuminate\Database\Seeder;
use App\Device;

class DevicesTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'slide' => 'device1.jpg',
                'home_page_image' => 'endospheres_for_face.jpg',
                'menu_logo' => 'sroface_logo.png',
                'head_ru' => 'для лица',
                'name' => 'ENDOSPHERES THERAPY® AK SR FACE',
                'image' => 'device1.jpg',
                'description_ru' => '(аппарат для лица) - терапия омоложения «Эндосфера», созданная итальянскими учеными',
                'content_ru' => '<p>Терапия «Эндосфера» для лица дает моментальный видимый эффект круговой подтяжки без скальпеля после первой же процедуры. Рекомендуемый курс 6-12 процедур (в зависимости от проблемы и состояния пациента).Терапия «Эндосфера» прекрасно сочетается с мезотерапией, контурной пластикой, кислородной оксигенацией, фотоомоложением. Существуют научные исследования и проверенные учеными и пластическими хирургами программы сочетания данных методик для достижения быстрого и качественного результата без нанесения вреда здоровью пациентов.<p>',
                'is_new' => true,
                'booklet' => '/pdfs/eva_buklet_445x150mm_web.pdf',
                'catalogue' => '/pdfs/katalog_eva_423x297_web.pdf',
                'active' => true,
                'chapter_id' => 3
            ],
            [
                'slide' => 'device2.jpg',
                'home_page_image' => 'endospheres_for_body.jpg',
                'menu_logo' => 'ak_sensorbody_logo.png',
                'head_ru' => 'для тела',
                'name' => 'ENDOSPHERES® AK SENSOR BODY',
                'image' => 'device2.jpg',
                'description_ru' => '(аппарат для тела) - сенсорная версия аппарата, выполняющего терапию Endospheres по телу.',
                'content_ru' => '<p>Специальный, встроенный в интерактивную манипулу, сенсорный датчик давления определяет стадию целлюлита, для проведения процедуры 100 % индивидуальной для каждого пациента. Не позволяет делать ошибки персоналу во время проведения процедуры. Контролирует интенсивность воздействия, в зависимости от состояния пациента и количества проведенных процедур.</p><p>Размер – 365х1105х365</p><p>Вес – 24,6 кг</p>',
                'is_new' => false,
                'booklet' => '/pdfs/buklet_aksensor.pdf',
                'catalogue' => '/pdfs/katalog_aksensor.pdf',
                'active' => true,
                'chapter_id' => 3
            ],
            [
                'slide' => 'device3.jpg',
                'home_page_image' => 'endospheres_for_body_and_face.jpg',
                'menu_logo' => 'ak_sensor_logo.png',
                'head_ru' => 'для тела и лица',
                'name' => 'ENDOSPHERES® AK SENSOR FACE',
                'image' => 'device3.jpg',
                'description_ru' => '(аппарат для тела и лица) - аппарат для комплексной терапии и тела, и лица, в сенсорной версии.',
                'content_ru' => '<p>Для желающих иметь в клинике или салоне весь спектр процедур метода "Эндосфера" терапия – аппарат для терапии тела и лица в сенсорной версии.</p><p>Все сразу и намного дешевле, чем по отдельности.</p><p>Уже пользуется большим спросом в Европе и России.</p>',
                'is_new' => false,
                'booklet' => '/pdfs/buklet_aksensorall.pdf',
                'catalogue' => '',
                'active' => true,
                'chapter_id' => 3
            ],
        ];

        foreach ($data as $item) {
            Device::create($item);
        }
    }
}