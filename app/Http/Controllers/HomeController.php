<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	public function index()
	{
		$questions = Question::orderBy('created_at', 'desc')->get();
		return view('home',compact('questions'));
	}

	public function search(Request $request){
		$full_text_search = Question::whereRaw(array('$text'=>array('$search'=> $request->keyword)))->get();
		$normal_search = Question::where('title','like',"%$request->keyword%")->get();

		$questions = $normal_search->merge($full_text_search);
		if($questions->count()<=0) return "";
		foreach($questions as $question){
			//{{ route(\'view-topic\',[\'id\'=>'.$question->_id.']) }}
			echo '<a id="result_id" href="/viewtopic/'.$question->_id.'" class="dropdown-item"><small>'.$question->title.'</small></a>';
		}
	}
	public function submit_search(Request $request){
		$full_text_search = Question::whereRaw(array('$text'=>array('$search'=> $request->keyword)))->get();
		$normal_search = Question::where('title','like',"%$request->keyword%")->get();

		$questions = $normal_search->merge($full_text_search);

		if($questions->count()>0) return redirect()->route('view-topic',['id'=>$questions[0]]);
		else return "not found!";
	}

}