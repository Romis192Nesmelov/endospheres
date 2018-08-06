<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = ['path','poster','head_ru','head_en','description_ru','description_en','background_color','mouse_color','is_image','active'];
    public $timestamps = false;
}