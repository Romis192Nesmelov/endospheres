<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Article extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $fillable = ['slug','head','content','active'];

    protected $sluggable = [
        'build_from' => 'head',
        'save_to'    => 'slug',
    ];
}