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
                'subscribe_ru' => '',
                'content_ru' => '<h2>КОМПРЕССИОННАЯ МИКРОВИБРАЦИЯ</h2><p>ENDOSPHERES THERAPY® – компрессионная микровибрация – инновационный метод лечения целлюлита. Основа метода – компрессия вместо вакуума, а, следовательно, отсутствие травм и быстрое решение проблем. Воздействие компрессионной микровибрации осуществляется за счет цилиндрической манипулы, которая содержит 50 вращающихся силиконовых сфер, расположенных в виде «пчелиных сот». Вибрация и компрессия создают эффект лимфатического насоса. Сочетание этих сил определяют интенсивность воздействия и позволяют адаптировать методику под потребности каждого пациента. </p><h2>МЕТОД ENDOSPHERES THERAPY®</h2><p>Метод ENDOSPHERES THERAPY® безопасен и неинвазивен, не вызывает повреждения венозных и лимфатических сосудов, рекомендуется в качестве болеутоляющей терапии. Новая технология «Эндосфера» для моделирования, снижения веса, решения проблем целлюлита, улучшения кровообращения и лимфотока. Дает хорошие результаты в лечении крупных мышц спины, ягодиц. Микровибрация ENDOSPHERES THERAPY® позволяет активизировать микроциркуляцию, улучшая трофику кожи и мышечной ткани. Работает по принципу «компрессия и вибрация» за счет вращения силиконовых сфер. Вибрация сфер совпадает с вибрацией жировых клеток, что дает активацию обмена веществ адипоцитов.</p>',
                'have_a_video' => true,
                'have_a_files' => false,
                'have_a_questions' => false,
                'active' => true
            ],
            [
                'head_ru' => 'Научная информация',
                'head_en' => 'Science information',
                'slide' => 'scince_info.jpg',
                'subscribe_ru' => 'Мануальный лимфодренаж по методу Воддера – одна из самых «античных» методик массажа, который стимулирует и активизирует лимфатическую систему, благодаря дренажному воздействию, что способствует выводу токсинов и очищает ткани. Этот метод был создан датским биологом и терапевтом Эмилем Воддером (1896-1986) в Европе в 1932-1936 годах в одном из институтов в Каннах, который специализировался на лечение хронических форм.',
                'content_ru' => '',
                'have_a_video' => true,
                'have_a_files' => true,
                'have_a_questions' => false,
                'active' => true
            ],
            [
                'head_ru' => 'Аппараты',
                'head_en' => 'Devices',
                'subscribe_ru' => '',
                'content_ru' => '',
                'have_a_video' => false,
                'have_a_files' => false,
                'have_a_questions' => false,
                'active' => true
            ],
            [
                'head_ru' => 'Вопросы и ответы',
                'head_en' => 'FAQ',
                'slide' => 'questions.jpg',
                'subscribe_ru' => 'На вопросы отвечает представитель фирмы производителя от лица создателя метода и оборудования Джанлуки Ковалетти.',
                'content_ru' => '',
                'have_a_video' => false,
                'have_a_files' => false,
                'have_a_questions' => true,
                'active' => true
            ],
            [
                'head_ru' => 'Результаты на реальных пациентах',
                'head_en' => 'Results on real patients',
                'subscribe_ru' => '',
                'content_ru' => '',
                'have_a_video' => false,
                'have_a_files' => false,
                'have_a_questions' => false,
                'active' => true
            ],
            [
                'head_ru' => 'Новости',
                'head_en' => 'News',
                'subscribe_ru' => '',
                'content_ru' => '',
                'have_a_video' => false,
                'have_a_files' => false,
                'have_a_questions' => false,
                'active' => true
            ],
            [
                'head_ru' => 'Сервис и обучение',
                'head_en' => 'Service & Training',
                'subscribe_ru' => '',
                'content_ru' => '',
                'have_a_video' => false,
                'have_a_files' => false,
                'have_a_questions' => false,
                'active' => true
            ],
            [
                'head_ru' => 'СМИ о нас',
                'head_en' => 'Mass media about us',
                'subscribe_ru' => '',
                'content_ru' => '',
                'have_a_video' => false,
                'have_a_files' => false,
                'have_a_questions' => false,
                'active' => true
            ],
            [
                'head_ru' => 'Рекомендации',
                'head_en' => 'Recommendations',
                'subscribe_ru' => '',
                'content_ru' => '',
                'have_a_video' => false,
                'have_a_files' => false,
                'have_a_questions' => false,
                'have_a_sheet' => true,
                'active' => true
            ],
            [
                'head_ru' => 'Контакты',
                'head_en' => 'Contacts',
                'subscribe_ru' => '',
                'content_ru' =>
                    '<div class="col-md-12 col-sm-12 col-xs-12">
                        <h2>ООО "ИТАЛКОНСАЛТ" - эксклюзивный представитель Endospheres Therapy® в России, Белоруссии, Казахстане, Азербайджане.</h2>
                        <p>121248, г. Москва, Кутузовский проспект, д. 13, офис 88</p>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <h3>
                            <a href="tel:+74959748014">+7 495 974-80-14</a><br>
                            <a href="tel:+79037990640">+7 903 799-06-40</a>
                        </h3>
                        <br>
                        <p><a href="mailto:solga@spamanagement.ru">solga@spamanagement.ru</a><br>Ольга Мариотти</p>
                        <br>
                        <p><a href="www.spa-management.ru" target="_blank">www.spa-management.ru</a><br><a href="www.fenixgroup.it" target="_blank">www.fenixgroup.it</a></p>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2245.6025325806013!2d37.55739011605438!3d55.74803469982695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b54bc5d89976f9%3A0xc8aa795ef5f7959a!2z0JrRg9GC0YPQt9C-0LLRgdC60LjQuSDQv9GA0L7RgdC_LiwgMTMsINCc0L7RgdC60LLQsCwgMTIxMjQ4!5e0!3m2!1sru!2sru!4v1534675915139" width="100%" height="280" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>',
                'have_a_video' => false,
                'have_a_files' => false,
                'have_a_questions' => false,
                'active' => true
            ]
        ];

        foreach ($data as $item) {
            Chapter::create($item);
        }
    }
}