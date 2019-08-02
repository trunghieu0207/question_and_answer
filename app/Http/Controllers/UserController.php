<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\User;
use File;
use Illuminate\Support\Facades\Hash;
use App\Notification;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

	public function indexManageQuestion()
	{
		$questions = Auth::user()->questions()->paginate(5);
		$active_manage_question = true;

		return view('profile.manage_question',compact('questions','active_manage_question'));
	}

	public function indexManageAnswer()
	{
		$answers = Auth::user()->answers()->paginate(5);
		$active_manage_answer = 'active';

		return view('profile.manage_answer',compact('answers','active_manage_answer'));
	}

	public function changeAvatar(Request $request)
	{
		if ($request->hasFile('avatar')) {
			$user = Auth::user();

			$filename = $user->_id.$request->avatar->getClientOriginalName();

			if($user->avatar!='default_avatar.png') File::delete('images/avatars/'.$user->avatar);
			$request->avatar->move('images/avatars/', $filename);
			
			$user->avatar=$filename;
			$user->save();

			Auth::user()->avatar = $filename;
		}
		
		return redirect()->back();
	}
	
	public function removeNotification($id)
	{
		$notification = Notification::find($id);
		if(Auth::user()->_id==$notification->user_id) $notification->delete();

		return redirect()->back();
	}

	public function readNotification()
	{
		$user = Auth::user();
		$user->read_notification=true;
		$user->save();
	}

	public function createNotification($user_id, $target, $action, $question_id)
	{
		$notification = new Notification();
		$notification->user_id = $user_id;
		$notification->actor_id = Auth::user()->_id;
		$notification->target = $target;
		$notification->action = $action;
		$notification->question_id = $question_id;
		$notification->save();
		
		$user = User::find($user_id);
		if($user->read_notification){
			$user->read_notification=false;
			$user->save();
		}
	}

	public function indexInformation () {
		$user = Auth::user();
		$active_personal_info = true;
		
		return view('profile.information',compact('user','active_personal_info'));
	}

	public function updateInformation (Request $request) {
		$user = Auth::user();
		$user->fullname = $request->fullname;
		$user->about_me = $request->aboutme;
		$user->save();
		Session()->put('username',$request->fullname);
		Session()->flash('message', 'Complete!');

		return redirect()->back();
	}

	public function indexChangePassword () {
		$id = Session()->get('id');
		$user = Auth::user();
		$active_change_pass = true;

		return view('profile.change_password',compact('user','active_change_pass'));
	}

	public function storeChangePassword(Request $request) {
		$user = Auth::user();
		$curentpassword = $user->password;
		if (!Hash::check($request->curentpassword, $curentpassword)) {

			Session()->flash('error', 'Current password is not correct!');
			
			return redirect()->back();       
		} else {
			$user->password = bcrypt($request->newpassword);
			$user->save();
			Session()->flash('message', 'Change password complete!');

			return redirect()->back();
		}  


	}
}
