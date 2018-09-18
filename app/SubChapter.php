<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class SubChapter extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $fillable = ['slide','subscribe_ru','subscribe_en','head_ru','head_en','content_ru','content_en','have_a_mm','have_a_resources','chapter_id'];

    protected $sluggable = [
        'build_from' => 'head_en',
        'save_to'    => 'slug',
    ];

    public function chapter()
    {
        return $this->belongsTo('App\Chapter');
    }

    public function reviews()
    {
        return $this->hasMany('App\Review','sub_chapter_id')->orderBy('id','desc');
    }

    public function results()
    {
        return $this->hasMany('App\PhotoResult','sub_chapter_id');
    }

    public function massMedia()
    {
        return $this->hasMany('App\MassMedia','sub_chapter_id')->orderBy('id','desc');
    }

    public function resources()
    {
        return $this->hasMany('App\Resource','sub_chapter_id')->orderBy('id','desc');
    }
}