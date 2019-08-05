<?php

namespace App\Http\Controllers;
use App\Question;
use App\User;
use App\User_Question_Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	public function index()
	{
		$questions = Question::orderBy('created_at', 'desc')->paginate(\Config::get('constants.options.ItemNumberPerPage'));
		$questions->setPath('/');
		foreach($questions as $question){

			$question->date = $question->created_at->diffForHumans();
		}
		
		return view('home',compact('questions'));
	}

	public function ajaxSearch(Request $request){
		$questions = $this->runSearch($request->keyword);
		if($questions->count()<=0) return "";

		foreach($questions as $question){
			echo '<a id="result_id" href="/viewtopic/'.$question->_id.'" class="dropdown-item"><small>'.htmlspecialchars($question->title).'</small></a>';
		}
	}

	public function searchIndex(Request $request){
		$keyword = $request->keyword;
		$questions = $this->runSearch($keyword);
		foreach($questions as $question){
			$question->date = $question->created_at->diffForHumans();
		}
		
		return view('question.search_result',compact('questions','keyword'));
	}

	public function runSearch($keyword){
		$full_text_search = Question::whereRaw(array('$text'=>array('$search'=> $keyword)))->get();

		return $full_text_search;
	}

	public function aboutUs()
	{
		return view('about_us');
	}

	public function personalInfomation($id)
	{
		$user = User::find($id);
		$totalLike = 0;
		$totalDislike = 0;
		$totalAccepted = 0;
		$questions = $user->questions;
		foreach($questions as $question){
			$totalLike += $question->total_like;
			$totalDislike += $question->total_dislike;
		}
		$answers = $user->answers;
		foreach($answers as $answer){
			$totalLike += $answer->total_like;
			$totalDislike += $answer->total_dislike;

			if($answer->question->best_answer_id==$answer->_id) $totalAccepted++;
		}

		return view('profile.personal_infomation',compact('user','totalLike','totalDislike','totalAccepted'));
	}
}