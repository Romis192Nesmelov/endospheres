<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoResult extends Model
{
    protected $fillable = [
        'path',
        'image_title_ru',
        'image_title_en',
        'head_ru',
        'head_en',
        'description_ru',
        'description_en',
        'sub_chapter_id'
    ];

    public function subChapter()
    {
        return $this->belongsTo('App\SubChapter','sub_chapter_id');
    }
}