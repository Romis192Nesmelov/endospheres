<?php

use Illuminate\Database\Seeder;
use App\Chapter;

class ChaptersTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'head_ru' => 'Главная',
                'head_en' => 'Home',
                'content_ru' => '
                    <h2>КОМПРЕССИОННАЯ МИКРОВИБРАЦИЯ</h2>
                    <p>ENDOSPHERES THERAPY® – компрессионная микровибрация – инновационный метод лечения целлюлита. Основа метода – компрессия вместо вакуума, а, следовательно, отсутствие травм и быстрое решение проблем. Воздействие компрессионной микровибрации осуществляется за счет цилиндрической манипулы, которая содержит 50 вращающихся силиконовых сфер, расположенных в виде «пчелиных сот». Вибрация и компрессия создают эффект лимфатического насоса. Сочетание этих сил определяют интенсивность воздействия и позволяют адаптировать методику под потребности каждого пациента. </p>
                    <h2>МЕТОД ENDOSPHERES THERAPY®</h2>
                    <p>Метод ENDOSPHERES THERAPY® безопасен и неинвазивен, не вызывает повреждения венозных и лимфатических сосудов, рекомендуется в качестве болеутоляющей терапии. Новая технология «Эндосфера» для моделирования, снижения веса, решения проблем целлюлита, улучшения кровообращения и лимфотока. Дает хорошие результаты в лечении крупных мышц спины, ягодиц. Микровибрация ENDOSPHERES THERAPY® позволяет активизировать микроциркуляцию, улучшая трофику кожи и мышечной ткани. Работает по принципу «компрессия и вибрация» за счет вращения силиконовых сфер. Вибрация сфер совпадает с вибрацией жировых клеток, что дает активацию обмена веществ адипоцитов.</p>
                ',
                'have_a_video' => true,
                'have_a_files' => false,
                'active' => true
            ],
            [
                'head_ru' => 'Научная информация',
                'head_en' => 'Science information',
                'content_ru' => '',
                'have_a_video' => false,
                'active' => true
            ],
            [
                'head_ru' => 'Аппараты',
                'head_en' => 'Devices',
                'content_ru' => '',
                'have_a_video' => false,
                'have_a_files' => false,
                'active' => true
            ],
            [
                'head_ru' => 'Вопросы и ответы',
                'head_en' => 'FAQ',
                'content_ru' => '',
                'have_a_video' => false,
                'have_a_files' => false,
                'active' => true
            ],
            [
                'head_ru' => 'Результаты на реальных пациентах',
                'head_en' => 'Results on real patients',
                'content_ru' => '',
                'active' => true
            ],
            [
                'head_ru' => 'Новости',
                'head_en' => 'News',
                'content_ru' => '',
                'have_a_video' => false,
                'have_a_files' => false,
                'active' => true
            ],
            [
                'head_ru' => 'Сервис и обучение',
                'head_en' => 'Service & Training',
                'content_ru' => '',
                'have_a_video' => false,
                'have_a_files' => false,
                'active' => true
            ],
            [
                'head_ru' => 'СМИ о нас',
                'head_en' => 'Mass media about us',
                'content_ru' => '',
                'have_a_video' => false,
                'have_a_files' => false,
                'active' => true
            ],
        ];

        foreach ($data as $item) {
            Chapter::create($item);
        }
    }
}