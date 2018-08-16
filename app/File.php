<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['path','head_ru','head_en','description_ru','description_en','type','chapter_id'];

    public function chapter()
    {
        return $this->belongsTo('App\Chapter');
    }
}