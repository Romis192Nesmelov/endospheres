<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class SubChapter extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $fillable = [
        'title',
        'meta_description',
        'meta_keywords',
        'meta_twitter_card',
        'meta_twitter_size',
        'meta_twitter_creator',
        'meta_og_url',
        'meta_og_type',
        'meta_og_title',
        'meta_og_description',
        'meta_og_image',
        'meta_robots',
        'meta_googlebot',
        'meta_google_site_verification',
        
        'slide',
        'slide_title_ru',
        'slide_title_en',
        'subscribe_ru',
        'subscribe_en',
        'head_ru',
        'head_en',
        'content_ru',
        'content_en',
        'have_a_mm',
        'have_a_resources',
        'chapter_id'
    ];

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