<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'article';

    protected $fillable = ['title','content','comment','view','image_path','date'];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
