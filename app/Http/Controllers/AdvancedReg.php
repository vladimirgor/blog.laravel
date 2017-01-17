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
            'name'  => 'required|max:150',
            'login' => 'required|max:150',
            'email' => 'required|max:250|email',
            'password' => 'required|confirmed|min:6',
        ]);
        $user=User::where('email','=',$request->input('email'))->first(); //делаем выборку из базы по введенному email

        if(!empty($user->email))
        {
            if($user->status==0)      // если email существует и его статус 0, то предлагаем повторно отправить письмо
            {
                return 'Такой email уже зарегестрирован, но не подтвержден.
                        роверьте почту или <a href="repeat_confirm">запросите</a>
                        повторное подтверждение email';

            }
            else  //если статус не равен 0, то равен 1, следовательно email уже подтвержден
            {
                return "Пользователь с таким email уже зарегестрирован. Забыли пароль?";
            }
        }

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
            Mail::send('email/confirm',['token'=>$token],function($u) use ($user)
            {
                $u->to($user->email);
                $u->subject('Confirm registration');
            });

            return back()->with('message','All right. Email confirmation left only.Check your email to confirm your email address.
            ');
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
        //return redirect('/');
    }

    public function getRepeat()

    {

        return view('auth.repeat');
//возвращаем вид с формой для ввода email
    }
    public function postRepeat(Request $request)
    {
        $user=User::where('email','=',$request->input('email'))->first(); //делаем выборку из таблицы users по указанному email

        if(!empty($user->email)) // проверяем, что email существует
        {
            if($user->status==0 )
            {
                $user->touch(); // это метод, который обновляет поле updated_at на текущее время.
                $confirm=ConfirmUsers::where('email','=',$request->input('email'))->first(); //делаем выборку из таблицы confrim_users
                $confirm->touch(); // тоже обновляем поле updated_at

                Mail::send('email/confirm',['token'=>$confirm->token], function($u) use ($user) //отправляем письмо пользователю
                {
                    $u->to($user->email);
                    $u->subject('Подтверждение email');
                });
                return back()->with('message','Письмо для активации успешно выслано на указанный адрес'); //возвращаем пользователя обратно с сообщением, что письмо отправленно
            }
            else {
                return "Такой email уже подтвержден";}
        }
        else { return "Нет пользователя с таким email";}

    }

}
