<?php
/**
 * Created by PhpStorm.
 * User: Владимир
 * Date: 22.10.2016
 * Time: 22:39
 */

namespace app;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model{
    protected $table = 'comment';
    protected $fillable = [
         'comment',
    ];
    public function article()
    {
        return $this->hasOne('App\Article');
    }
    public function user(){
        return $this->hasOne('App\User');
    }
}