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
        //классная функция в Laravel, котороая проверяет учетные данные в таблице users
        {
            return redirect('/');
        }
        else {
            return back()->with('message','Не правильный логин или пароль, а может не подтвержден email');
        }

    }

}
