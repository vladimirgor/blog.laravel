<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MyAuth extends Controller
{
    public function auth(Request $request) {
        if (Auth::attempt(['login' => $request->input('login'), 'password' => $request->input('password'),'status'=>'1']))
        {
            return redirect('/');
        }
        else {

            return back()->with('message','Not a valid login and password, and may be email is not confirmed.');
        }

    }

}
