<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model implements SluggableInterface
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
        'have_a_video',
        'have_a_files',
        'have_a_questions',
        'have_a_sheet',
        'active'
    ];

    protected $sluggable = [
        'build_from' => 'head_en',
        'save_to'    => 'slug',
    ];

    public function subChapters()
    {
        return $this->hasMany('App\SubChapter');
    }
    
    public function videos()
    {
        return $this->hasMany('App\Video');
    }

    public function devices()
    {
        return $this->hasMany('App\Device');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }

    public function questions()
    {
        return $this->hasMany('App\Question')->orderBy('id','desc');
    }

    public function news()
    {
        return $this->hasMany('App\News')->orderBy('time','desc');
    }

    public function sheets()
    {
        return $this->hasMany('App\Sheet')->orderBy('time','desc');
    }
}