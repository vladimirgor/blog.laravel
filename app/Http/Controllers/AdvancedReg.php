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
            'name'  => 'required|max:150', // entered name
            'login' => 'required|max:150', // entered login
            'email' => 'required|max:250|email', // entered email
            'password' => 'required|confirmed|min:6', // entered password
        ]);
        
        $user=User::where('email','=',$request->input('email'))->first(); //selection from the user table  according to the entered email

        if(!empty($user->email)) // if exist user with the entered email
        {
            if($user->status==0)      // if email exists and the status 0, the offer to re-send a confirmation letter
            {
                return view('info') -> with(['level' => 'warning','title'=>'Warning',
                    'text' => 'Entered email is already registered, but not confirmed.
                       Please, check your email or <a href="repeat_confirm">ask for</a>
                       re-confirmation email.']);
            }
            else  //If status is not equal to 0, 1 is thus already been verified email
            {
                return back()->with('message','A person with the entered email is already registered.
                Please check your email.');
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
        { // if the user insert is successful
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
            return view('info') -> with(['level' => 'default','title' => 'Information',
                'text' => 'The confirmation link is sent to your email.
            Please,check your email.']);
        }
        else {//if the user insert is not successful

            return view('info') -> with(['level' => 'danger','title' => 'Wrong operation',
                'text' => 'Something went wrong.Please,try again later.']);
        }
    }
    public function confirm($token)
    {
        $model=ConfirmUsers::where('token','=',$token)->firstOrFail(); //record with link token select, 404 error if missing
        $user=User::where('email','=',$model->email)->first(); //record with email  select
        $user->status=1; // status change to 1
        $user->save();  // save changing
        $model->delete(); //confirm_users record delete
        return view('info')->with(['level' => 'success','title' => 'Success',
            'text'=>'Registration is finished successfully. Congratulations!']);
    }

    public function getRepeat()

    {

        return view('auth.repeat');
//return the view  with  the form to enter email
    }
    public function postRepeat(Request $request)
    {
        $user=User::where('email','=',$request->input('email'))->first(); //record with entered email select from user table

        if(!empty($user->email)) // is email existing
        {
            if($user->status==0 )
            {
                $user->touch(); //updating the updated_at field at the current time.
                $confirm=ConfirmUsers::where('email','=',$request->input('email'))->first(); //record with entered email select from confrim_users table
                $confirm->touch(); // updating the updated_at field at the current time.

                Mail::send('email/confirm',['token'=>$confirm->token], function($u) use ($user) //send confirmation letter to user
                {
                    $u->to($user->email);
                    $u->subject('Email confirmation');
                });
                return view('info')->with(['level'=>'default', 'title' => 'Information',
                    'text' => 'Link to confirm is successfully sent to the entered email.']); //return with  that the message was sent
            }
            else
                return back()->with('message','The entered email has been confirmed already.
                Please check your email.');
        }
        else
            //return view('info')->with(['level'=>'warning','title'=>'Warning',
            //'text' => 'No user with the entered email.']);
            return back()->with('message','No user with the entered email.
             Please check your email.');
    }

}
