<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function getSignUp(){
        return view('signup');
    }
    public function postSignUp(Request $request){
		$user = User::where('email', '=', $request->email)->get();
		if($user->count()==0){
			$user = new User();
			$user->fullname=$request->fullname;
			$user->email=$request->email;
			$user->password=bcrypt($request->password);
			$user->save();

			//Auth::login($user);
			//session()->put('_id',$user->_id);
			//session()->put('username',$user->name);
			return "success!";
		}
		else return "This email has been used!";
    }
    public function validEmail(Request $request){
		$user = User::where('email', '=', $request->email);
		$result = true;
		if($user->count()>0) $result=false;

		return response()->json($result);
	}
}
