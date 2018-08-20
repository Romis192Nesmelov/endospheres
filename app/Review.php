<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['name_ru','name_en','review_ru','review_en','sub_chapter_id'];

    public function subChapter()
    {
        return $this->belongsTo('App\SubChapter','sub_chapter_id');
    }
}