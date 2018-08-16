<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['url','head_ru','head_en','description_ru','description_en','chapter_id'];

    public function chapter()
    {
        return $this->belongsTo('App\Chapter');
    }
}