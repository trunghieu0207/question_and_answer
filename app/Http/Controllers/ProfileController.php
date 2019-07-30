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
    public function index_manage_question()
	{
        $questions = Question::where('user_id', '=', session('id'))->get();
        $active_manage_question = true;
		return view('manage_question',compact('questions','active_manage_question'));
    }

    public function index_manage_answer()
	{
        $answers = Answer::where('user_id', '=', session('id'))->get();
        $active_manage_answer = true;
		return view('manage_answer',compact('answers','active_manage_answer'));
    }

    public function remove_question(Request $request)
	{
        (new QuestionController)->remove_question($request);
        return redirect()->route('manage_question');
    }

    public function change_avatar(Request $request)
    {
		if ($request->hasFile('avatar')) {
            $user = User::find(session('id'));

            $filename = $user->_id.$request->avatar->getClientOriginalName();

            if($user->avatar!='default_avatar.png') File::delete('img\avatar\\'.$user->avatar);
            $request->avatar->move('img\avatar\\', $filename);
            
            $user->avatar=$filename;
            $user->save();

            Session()->put('avatar','img\avatar\\'.$user->avatar);
        }
        return redirect('profile');
    }
    
    public function indexInformation () {
        $user = Auth::user();
        $active_personal_info = true;
        return view('information',compact('user','active_personal_info'));
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
        return view('changepassword',compact('user','active_change_pass'));
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
    public function getNotifications()
    {
        $user->notifications();

        $notifications = Notification::where('user_id','=',Session::get('id'))->get();
        return $notifications;
    }
}
