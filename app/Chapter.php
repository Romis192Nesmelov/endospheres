<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $fillable = ['slug','head_ru','head_en','content_ru','content_en','active'];

    protected $sluggable = [
        'build_from' => 'head_en',
        'save_to'    => 'slug',
    ];
}