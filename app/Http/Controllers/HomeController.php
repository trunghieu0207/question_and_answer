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
		$questions = Question::orderBy('created_at', 'desc')->paginate(5);
		$questions->setPath('/');
		foreach($questions as $question){

			$question->date = $question->created_at->diffForHumans();
		}
		
		return view('home',compact('questions'));
	}

	public function search(Request $request){
		$questions = $this->runSearch($request->keyword);
		if($questions->count()<=0) return "";

		$havingInput = false;
		foreach($questions as $question){
			echo '<a id="result_id" href="/viewtopic/'.$question->_id.'" class="dropdown-item"><small>'.htmlspecialchars($question->title).'</small></a>';
			if(!$havingInput){
				echo '<input type="text" name="question_id" value="'.$question->_id.'" hidden>';
				$havingInput=true;
			}
		}
	}

	public function submitSearch(Request $request){
		if($request->question_id) return redirect()->route('viewTopic',['id'=>$request->question_id]);

		return redirect()->back();
	}

	public function runSearch($keyword){
		$full_text_search = Question::whereRaw(array('$text'=>array('$search'=> $keyword)))->get();
		$normal_search = Question::where('title','like',"%$keyword%")->orwhere('content','like',"%$keyword%")->get();

		return $normal_search->merge($full_text_search);
	}

	public function aboutUs()
	{
		return view('about_us');
	}
}