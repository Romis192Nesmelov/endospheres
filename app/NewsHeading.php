<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class NewsHeading extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $fillable = ['slide','subscribe_ru','subscribe_en','head_ru','head_en'];

    protected $sluggable = [
        'build_from' => 'head_ru',
        'save_to'    => 'slug',
    ];

    public function news()
    {
        return $this->hasMany('App\News','news_heading_id')->orderBy('time','desc');
    }
}