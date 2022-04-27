<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class NewsHeading extends Model implements SluggableInterface
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
        'head_en'
    ];

    protected $sluggable = [
        'build_from' => 'head_ru',
        'save_to'    => 'slug',
    ];

    public function news()
    {
        return $this->hasMany('App\News','news_heading_id')->orderBy('time','desc');
    }
}