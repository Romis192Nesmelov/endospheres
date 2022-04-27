<?php

use Illuminate\Database\Seeder;
use App\File;

class FilesTableSeeder extends Seeder
{
    public function run()
    {
        $data =
            [
                [
                    'path' => '/pdfs/1_nauchnaya_infa.pdf',
                    'head_ru' => 'Научные исследования метода Endospheres Therapy®',
                    'description_ru' => '',
                    'type' => 'pdf',
                    'chapter_id' => 2
                ],
                [
                    'path' => '/pdfs/anamnez.pdf',
                    'head_ru' => 'ЦЕНТР ДОКУМЕНТИРОВАНИЯ ЭСТЕТИЧЕСКИХ ПАТОЛОГИЙ – АРЕЦЦО Международный центр изучения эстетических патологий ног',
                    'description_ru' => '',
                    'type' => 'pdf',
                    'chapter_id' => 2
                ],
            ];

        foreach ($data as $item) {
            File::create($item);
        }
    }
}