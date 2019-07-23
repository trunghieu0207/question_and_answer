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
class Signin extends Controller
{
    public function view(){
    	return view('page.signin');
    }
    public function viewtest(){
        return view('page.test');
    }

    public function postSignIn(Request $request) {
        $email = $request->email;
        $password = $request->password;

        if(Auth::attempt(['email'=>$email, 'password'=>$password]))
        {
        	return redirect()->route('profile');
        }
        else
        {
        	return view('page.signin');
        }
    }
}
