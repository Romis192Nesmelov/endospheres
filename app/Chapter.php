<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $fillable = ['slide','subscribe_ru','subscribe_en','head_ru','head_en','content_ru','content_en','have_a_video','have_a_files','have_a_questions','active'];

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
        return $this->hasMany('App\News')->orderBy('id','desc')->paginate(10);
    }
}