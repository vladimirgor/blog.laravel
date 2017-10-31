<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    public function privs ()
    {
        return $this->belongsToMany('App\Priv','priv_for_roles');
    }
}
