<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['name'];
    public function cars ()
    {
        return $this->belongsToMany('App\Car');
    }

}
