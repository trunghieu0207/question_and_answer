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

class ProfileController extends Controller
{
    public function indexManageQuestion()
	{
        $questions = Auth::user()->questions()->get();
        $active_manage_question = true;

		return view('manage_question',compact('questions','active_manage_question'));
    }

    public function indexManageAnswer()
	{
        $answers = Auth::user()->answers()->get();
        $manage_answer = 'active';

		return view('manage_answer',compact('answers','manage_answer'));
    }

    public function removeQuestion(Request $request)
	{
        return (new QuestionController)->destroy($request);
    }

    public function changeAvatar(Request $request)
    {
		if ($request->hasFile('avatar')) {
            $user = Auth::user();

            $filename = $user->_id.$request->avatar->getClientOriginalName();

            if($user->avatar!='default_avatar.png') File::delete('img\avatar\\'.$user->avatar);
            $request->avatar->move('img\avatar\\', $filename);
            
            $user->avatar=$filename;
            $user->save();

            Auth::user()->avatar = $filename;
        }
        return redirect('profile');
    }
    
    public function getNotifications()
    {
        return Auth::user()->notifications()->get();;
    }

    public function getInformation () {
        $id = Session()->get('id');
        $user = User::find($id);
        $active_personal_info = true;
        return view('information',compact('user','active_personal_info'));
    }

    public function postInformation (Request $request) {

        $id = Session()->get('id');
        $user = User::find($id);
        $user->fullname = $request->fullname;
        $user->about_me = $request->aboutme;
        $user->save();
        Session()->put('username',$request->fullname);
        Session()->flash('message', 'Complete!');
        return redirect()->back();
    }

    public function getChangepassword () {
        $id = Session()->get('id');
        $user = User::find($id);
        $active_change_pass = true;
        return view('changepassword',compact('user','active_change_pass'));
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
