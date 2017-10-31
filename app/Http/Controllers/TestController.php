<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests;
use App\Car;
use App\Driver;

class TestController extends Controller
{
    public function index($driver=2,$car='volga'){

        $items = Driver::find($driver)->cars()->
            where('name','=',$car)->get();
        //$items = ['first','second','third'];
        return view('test')->with(['items'=>$items]);

    }
}
