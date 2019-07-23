<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use \App\User;
use Illuminate\Support\Facades\Schema;
use \App\Chitiet;
use DB;
use Illuminate\Support\collection;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Validator;
use App\Http\Requests\LoginRequest;

class SignInController extends Controller
{
    public function view(){
    	return view('signin');
    }
    public function viewtest(){
        return view('test');
    }

    public function postSignIn(Request $request) {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', '=', $email)->first();
        if(Auth::attempt(['email'=>$email, 'password'=>$password]))
        {
            Session()->put('id',$user->_id);
            Session()->put('username',$user->fullname);
            return redirect()->route('home-page');
        }
        else
        {
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'approve' => 'The email or password is incorrect.',
            ]);
         //    Session()->flash('error','The email or password is incorrect');
        	// return view('page.signin');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('sign-in');
    }
}