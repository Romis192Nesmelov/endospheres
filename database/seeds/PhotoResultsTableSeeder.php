<?php

use Illuminate\Database\Seeder;
use App\PhotoResult;

class PhotoResultsTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'path' => '/images/photo_results/result1.jpg',
                'head_ru' => 'Результаты после 6 процедур Эндосфера® Терапия по телу',
                'description_ru' => 'Laguna Expert Beauty Group, Екатеринбург',
                'sub_chapter_id' => 4
            ],
            [
                'path' => '/images/photo_results/result2.jpg',
                'head_ru' => 'Результаты после 6 процедур Эндосфера® Терапия по телу',
                'description_ru' => 'Laguna Expert Beauty Group, Екатеринбург',
                'sub_chapter_id' => 4
            ],
            [
                'path' => '/images/photo_results/result3.jpg',
                'head_ru' => 'Результаты после 6 процедур Эндосфера® Терапия по телу',
                'description_ru' => 'Laguna Expert Beauty Group, Екатеринбург',
                'sub_chapter_id' => 4
            ],
            [
                'path' => '/images/photo_results/result4.jpg',
                'head_ru' => 'Результаты после 6 процедур Эндосфера® Терапия по телу',
                'description_ru' => 'Салон красоты ОК! Москва',
                'sub_chapter_id' => 4
            ],
            [
                'path' => '/images/photo_results/result5.jpg',
                'head_ru' => 'Результаты после 6 процедур Эндосфера® Терапия по телу',
                'description_ru' => 'Салон красоты ОК! Москва',
                'sub_chapter_id' => 4
            ],
        ];

        foreach ($data as $item) {
            PhotoResult::create($item);
        }
    }
}