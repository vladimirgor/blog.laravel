<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\ConfirmUsers;

use Illuminate\Support\Facades\Mail;

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
            $email=$user->email;  // user email
            $token=str_random(32); //random string
            $model=new ConfirmUsers; //new model instance
            $model->email=$email; // email to model
            $model->token=$token; //random string to model
            $model->save();      // save all data
//send link with token to user

            //return  view('email/confirm')-> with(['token'=>$token]);
            Mail::send('email/confirm',['token'=>$token],function($u) use ($user)
            {
                //$u->from('admin@site.ru');
                $u->to($user->email);
                $u->subject('Confirm registration');
            });

            return back()->with('message','All right. Email confirmation left only.
            Наша читерская  <a href="/register/confirm/'.$token.'">Ссылка</a> для подтверждения почты');
        }
        else {
            return back()->with('message','Something went wrong.Please try again later.');
        }
    }
    public function confirm($token)
    {
        $model=ConfirmUsers::where('token','=',$token)->firstOrFail(); //record with link token select, 404 error if missing
        $user=User::where('email','=',$model->email)->first(); //record with link token select
        $user->status=1; // status change to 1
        $user->save();  // save changing
        $model->delete(); //Удаляем запись из confirm_users record delete
        return "Registration is finished successfully. Congratulations!";
    }

}
