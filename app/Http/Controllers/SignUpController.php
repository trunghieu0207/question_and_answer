<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use File;
use Validator;
use Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\SignUpRequests;

class SignUpController extends Controller
{
    public function getSignUp(){
        return view('signup');
    }
    public function postSignUp(SignUpRequests $request){

		$user = User::where('email', '=', $request->email)->get();
		if($user->count()==0){
			$user = new User();
			$user->fullname=$request->fullname;
			$user->email=$request->email;
			$user->password=bcrypt($request->password);
			$user->avatar = "default_avatar.png";
			$user->save();			
			return redirect()->route('sign-in');
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
