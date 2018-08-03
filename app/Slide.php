<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = ['path','head_ru','head_en','description_ru','description_en','is_image','active'];
    public $timestamps = false;
}