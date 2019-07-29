<?php

namespace App\Http\Controllers;
use App\Answer;
use Illuminate\Http\Request;
use App\Question;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{

	public function store(Request $request)
	{
		$answer = new Answer();
		$answer->content = $request->get('content');
		$answer->user_id = session('id');
		$answer->question_id = $request->get('question_id');
		$id_question=$answer->question_id;
        $question = Question::find($id_question);
        $question->total_answer+=1;
        $question->save();
		$answer->save();
		return redirect()->route('view-topic', ['id' => $answer->question_id]);
	}

	public function edit($id)
	{

		$answer = Answer::find($id);
		$question = Question::where('_id', '=',$answer->question_id)->get();
		return view('editanswer',compact('answer','id','question'));

		if(Auth::check()){
			$answer = Answer::find($id);
			if(empty($answer)) {
				return redirect()->route('home-page');
			} else{
				$question = Question::where('_id', '=',$answer->question_id)->get();
				return view('editanswer',compact('answer','id','question'));
			}
		} else {
			return view('signin');
		}

	}

	public function update(Request $request, $id)
	{
		$answer = Answer::find($id);
		$answer->content = $request->get('content');
		$answer->save();
		return redirect()->route('view-topic', ['id' => $answer->question_id]);
	}
}
