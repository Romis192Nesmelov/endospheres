<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Device extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $fillable = ['slide','home_page_image','menu_logo','head_ru','head_en','name','image','description_ru','description_en','content_ru','content_en','is_new','active','chapter_id'];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];

    public function chapter()
    {
        return $this->belongsTo('App\Chapter');
    }
}