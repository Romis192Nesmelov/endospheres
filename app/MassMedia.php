<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MassMedia extends Model
{
    protected $fillable = ['preview','full','description_ru','description_en','year','is_pdf','sub_chapter_id'];

    public function subChapter()
    {
        return $this->belongsTo('App\SubChapter','sub_chapter_id');
    }
}