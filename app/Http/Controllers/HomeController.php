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
		$limit=\Config::get('constants.options.ItemNumberPerPage');
		$questions = Question::orderBy('created_at', 'desc')->paginate($limit);
		$questions->setPath('/');
		
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
		
		return view('question.search_result',compact('questions','keyword'));
	}

	public function runSearch($keyword){
		$fullText = Question::whereRaw(array('$text'=>array('$search'=> $keyword)))->get();

		return $fullText;
	}
}