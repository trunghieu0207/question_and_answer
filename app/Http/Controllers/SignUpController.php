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
    public function index() {
        return view('log.signup');
	}
	
    public function store(SignUpRequests $request) {
		$data = $request->validate([
			'fullname' => 'required',
			'email' => 'email|unique:antman_users,email',
			'password' => 'min:5|max:30',
		]);

		$user = new User();
		$user->fullname=$data->fullname;
		$user->email=$data->email;
		$user->password=bcrypt($data->password);
		$user->avatar = "default_avatar.png";
		$user->about_me = null;
		$user->save();		
		return redirect()->route('sign-in');
	}
	
    public function validEmail(Request $request) {
		$user = User::where('email', $request->email);
		$result = $user->count()==0 ? true : false;

		return response()->json($result);
	}

}
