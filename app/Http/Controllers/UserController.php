<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
	public function getInformation ($id) {
		$user = User::find($id);
		return view('information',compact('user'));
	}
	public function postInformation (Request $request) {

		$id = Session()->get('id');
		$user = User::find($id);
		$user->fullname = $request->fullname;
		$user->about_me = $request->aboutme;
		$user->save();
		Session()->flash('message', 'Complete!');
		return redirect()->back();
	}

	public function getChangepassword ($id) {
		$user = User::find($id);
		return view('changepassword',compact('user'));
	}

	public function postChangepassword(Request $request) {
		$id = Session()->get('id');
		$user = User::find($id);
		$curentpassword = $user->password;
		if (Hash::check($request->curentpassword, $curentpassword)) {
			$user->password = bcrypt($request->newpassword);
			$user->save();
			Session()->flash('message', 'Change password complete!');
   			return redirect()->back();
		} else {
			Session()->flash('error', 'Current password is not correct!');
   			return redirect()->back();
		}
		
	}

}
