<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	public function index()
	{
		$questions = Question::all();
		if(Auth::check()){
			$notifications = Notification::where('user_id','=',session('id'))->get();
			return view('home',compact('questions','notifications'));
		}
		return view('home',compact('questions'));
	}
	public function search(Request $request){
		$questions = Question::whereRaw(array('$text'=>array('$search'=> $request->keyword)))->get();
		if($questions->count()<=0) return "";
		foreach($questions as $question){
			echo '<a class="dropdown-item" href="#"><small>'.$question->title.'</small></a>';
		}
	}
	public function search_test(Request $request){
		$questions = Question::whereRaw(array('$text'=>array('$search'=> $request->keyword)))->get();
		if($questions->count()>0) return $questions;
		else return 'None.';
	}
}