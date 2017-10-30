<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests;
use App\Role;

class TestController extends Controller
{
    public function index($role=4,$priv=2){
        $items = Role::where('id_role','=',$role)->get();
        //$items = ['first','second','third'];
        return view('test')->with(['items'=>$items]);

    }
}
