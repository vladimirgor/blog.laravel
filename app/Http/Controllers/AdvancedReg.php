<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\ConfirmUsers;

use Mail;

class AdvancedReg extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|unique:users|max:150',
            'login' => 'required|unique:users|max:150',
            'email' => 'required|unique:users|max:250|unique:confirm_users|email',
            'password' => 'required|confirmed|min:6',
        ]);

//Insert user
        $user=User::create([
            'name' => $request->input('name'),
            'login' => $request->input('login'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        if($user)
        {
            $email=$user->email;  //это email, который ввел пользователь
            $token=str_random(32); //это наша случайная строка
            $model=new ConfirmUsers; //создаем экземпляр нашей модели
            $model->email=$email; //вставляем в таблицу email
            $model->token=$token; //вставляем в таблицу токен
            $model->save();      // сохраняем все данные в таблицу
//отправляем ссылку с токеном пользователю
            //return  view('email/confirm')-> with(['token'=>$token]);
            Mail::send('email/confirm',['token'=>$token],function($u) use ($user)
            {
                //$u->from('admin@site.ru');
                $u->to($user->email);
                $u->subject('Confirm registration');
            });

            return back()->with('message','Все классно, осталось подтвердить почту. Наша читерская  <a href="/register/confirm/'.$token.'">Ссылка</a> для подтверждения почты');
        }
        else {
            return back()->with('message','Беда с базой, попробуй позже');
        }
    }
    public function confirm($token)
    {
        $model=ConfirmUsers::where('token','=',$token)->firstOrFail(); //выбираем запись с переданным токеном, если такого нет то будет ошибка 404
        $user=User::where('email','=',$model->email)->first(); //выбираем пользователя почта которого соответствует переданному токену
        $user->status=1; // меняем статус на 1
        $user->save();  // сохраняем изменения
        $model->delete(); //Удаляем запись из confirm_users
        return "Регистрация закончена";
    }

}
