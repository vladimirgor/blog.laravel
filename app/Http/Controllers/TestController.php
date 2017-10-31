<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function index() {
        $items = ['one','two','three','four'];
        return view('test',['items'=>$items]);
    }
}
