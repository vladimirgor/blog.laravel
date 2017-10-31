<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['name'];
    public function drivers()
    {
        return $this->belongsToMany('App\Driver');
    }
}
