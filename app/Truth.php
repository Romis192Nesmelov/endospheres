<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Truth extends Model
{
    protected $fillable = ['head','content','time','active'];

    public $timestamps = false;
}