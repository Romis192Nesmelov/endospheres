<?php

use Illuminate\Database\Seeder;
use App\File;

class FilesTableSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i=0;$i<10;$i++) {
            $data[] = [
                'path' => '/pdfs/a4.pdf',
                'head_ru' => 'AK SENSOR ENDOSPHERES THERAPY',
                'description_ru' => 'ENDOSPHERES THERAPY® – компрессионная микровибрация – инновационный метод лечения целлюлита. Основа метода – компрессия вместо вакуума, а, следовательно, отсутствие травм и быстрое решение проблем.',
                'type' => 'pdf',
                'chapter_id' => 1
            ];
        }

        foreach ($data as $item) {
            File::create($item);
        }
    }
}