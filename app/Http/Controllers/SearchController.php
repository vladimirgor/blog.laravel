<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SearchController extends Controller
{
    public function searchForm(){

        return view('searchForm');
    }
    public function searchShow(Request $request){

        $this->validate($request,[
            'searchText' => 'required',
        ]);
        //print_r($_POST);
        return view('searchShow')->with(['request'=>$request]);

    }
}
