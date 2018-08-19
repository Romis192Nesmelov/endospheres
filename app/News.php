<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class News extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $fillable = ['slide','head_ru','head_en','description_ru','description_en','content_ru','content_en','news_heading_id','chapter_id','time','active'];

    protected $sluggable = [
        'build_from' => 'head_ru',
        'save_to'    => 'slug',
    ];

    public $timestamps = false;

    public function chapter()
    {
        return $this->belongsTo('App\Chapter');
    }

    public function heading()
    {
        return $this->belongsTo('App\NewsHeading','news_heading_id');
    }
}