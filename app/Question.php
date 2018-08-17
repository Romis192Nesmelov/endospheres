<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question_ru','question_en','answer_ru','answer_en','chapter_id'];

    public function chapter()
    {
        return $this->belongsTo('App\Chapter');
    }
}