<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Carbon\Carbon;

class HomeController extends Controller
{
	public function index()
	{
		$questions = Question::orderBy('created_at', 'desc')->get();
		foreach($questions as $question){
			$question->date = $question->created_at->diffForHumans();
		}
		
		return view('home',compact('questions'));
	}

	public function search(Request $request){
		$questions = $this->runSearch($request->keyword);
		if($questions->count()<=0) return "";
		//htmlspecialchars($question->title, ENT_QUOTES, 'UTF-8');
		foreach($questions as $question){
			echo '<a id="result_id" href="/viewtopic/'.$question->_id.'" class="dropdown-item"><small>'.htmlspecialchars($question->title, ENT_QUOTES, 'UTF-8').'</small></a>';
		}
	}

	public function submitSearch(Request $request){
		$questions = $this->runSearch($request->keyword);

		if($questions->count()==0) return "not found!";

		return redirect()->route('viewTopic',['id'=>$questions[0]]);
	}

	public function runSearch($keyword){
		$full_text_search = Question::whereRaw(array('$text'=>array('$search'=> $keyword)))->get();
		$normal_search = Question::where('title','like',"%$keyword%")->get();

		return $normal_search->merge($full_text_search);
	}
}