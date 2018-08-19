<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class SubChapter extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $fillable = ['slide','head_ru','head_en','content_ru','content_en','chapter_id'];

    protected $sluggable = [
        'build_from' => 'head_en',
        'save_to'    => 'slug',
    ];

    public function chapter()
    {
        return $this->belongsTo('App\Chapter');
    }
}