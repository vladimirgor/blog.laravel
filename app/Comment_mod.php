<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_mod extends Model
{
    protected $table = 'comment_mod';
    protected $fillable = [
        'id','status'
    ];
}
