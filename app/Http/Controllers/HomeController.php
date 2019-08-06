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
			echo view('layout.search_link',compact('question'));
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
		$questions = $user->questions;
		$answers = $user->answers;
		$totalLike = $questions->sum('total_like')+$answers->sum('total_like');
		$totalDislike = $questions->sum('total_dislike')+$answers->sum('total_dislike');
		$totalAccepted = 0;
		foreach($answers as $answer){
			if($answer->question->best_answer_id==$answer->_id) $totalAccepted++;
		}

		return view('profile.personal_infomation',compact('user','totalLike','totalDislike','totalAccepted'));
	}
}