<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Device extends Model implements SluggableInterface
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
        'home_page_image',
        'home_page_image_title_ru',
        'home_page_image_title_en',
        'menu_logo',
        'head_ru',
        'head_en',
        'name',
        'image',
        'image_title_ru',
        'image_title_en',
        'description_ru',
        'description_en',
        'content_ru',
        'content_en',
        'is_new',
        'active',
        'booklet',
        'catalogue',
        'chapter_id'
    ];

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
    ];

    public function chapter()
    {
        return $this->belongsTo('App\Chapter');
    }
}