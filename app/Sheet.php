<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    protected $fillable = ['head','content','time','active','chapter_id'];

    public $timestamps = false;

    public function chapter()
    {
        return $this->belongsTo('App\Chapter');
    }
}