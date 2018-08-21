<?php

use Illuminate\Database\Seeder;
use App\Video;

class VideosTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'url' => '<iframe allowfullscreen="" frameborder="0" height="300" src="//www.youtube.com/embed/2svMVyChh1U" width="100%"></iframe>',
                'head_ru' => 'AK SENSOR ENDOSPHERES THERAPY',
                'description_ru' => 'ENDOSPHERES THERAPY® – компрессионная микровибрация – инновационный метод лечения целлюлита. Основа метода – компрессия вместо вакуума, а, следовательно, отсутствие травм и быстрое решение проблем.',
                'chapter_id' => 1
            ],
            [
                'url' => '<iframe width="100%" height="300" src="//www.youtube.com/embed/7jeI_E6rHsM" frameborder="0" allowfullscreen=""></iframe>',
                'head_ru' => 'AK SENSOR FACE ENDOSPHERES THERAPY',
                'description_ru' => 'ENDOSPHERES THERAPY® – компрессионная микровибрация – инновационный метод лечения целлюлита. Основа метода – компрессия вместо вакуума, а, следовательно, отсутствие травм и быстрое решение проблем.',
                'chapter_id' => 1
            ],
            [
                'url' => '<iframe width="100%" height="300" src="https://www.youtube.com/embed/iPRwfKd5rY8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>',
                'head_ru' => 'Создатель метода Терапии Эндосфера - инженер Джанлука Каваллетти о методе Endospheres Therapy®',
                'description_ru' => '',
                'chapter_id' => 2
            ],
        ];

        foreach ($data as $item) {
            Video::create($item);
        }
    }
}