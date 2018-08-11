<?php

use Illuminate\Database\Seeder;
use App\Video;

class VideosTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'url' => '<iframe width="100%" height="300" src="https://www.youtube.com/embed/gOsM-DYAEhY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>',
                'head_ru' => 'AK SENSOR ENDOSPHERES THERAPY',
                'description_ru' => 'ENDOSPHERES THERAPY® – компрессионная микровибрация – инновационный метод лечения целлюлита. Основа метода – компрессия вместо вакуума, а, следовательно, отсутствие травм и быстрое решение проблем.',
                'chapter_id' => 1
            ],
            [
                'url' => '<iframe width="100%" height="300" src="https://www.youtube.com/embed/2bQQ_4rXxFw" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>',
                'head_ru' => 'AK SENSOR FACE ENDOSPHERES THERAPY',
                'description_ru' => 'ENDOSPHERES THERAPY® – компрессионная микровибрация – инновационный метод лечения целлюлита. Основа метода – компрессия вместо вакуума, а, следовательно, отсутствие травм и быстрое решение проблем.',
                'chapter_id' => 1
            ],
        ];

        foreach ($data as $item) {
            Video::create($item);
        }
    }
}