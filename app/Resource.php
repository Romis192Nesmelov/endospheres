<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['logo','logo_title_ru','logo_title_en','url','description_ru','description_en','sub_chapter_id'];

    public $timestamps = false;

    public function subChapter()
    {
        return $this->belongsTo('App\SubChapter','sub_chapter_id');
    }
}