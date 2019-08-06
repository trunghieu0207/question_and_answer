<?php

namespace App\Http\Controllers;
use App\Answer;
use Illuminate\Http\Request;
use App\Question;
use App\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use File;
use App\Http\Requests\AnswerRequest;
class AnswerController extends Controller
{

	public function store(AnswerRequest $request)
	{

		$question= Question::find("$request->question_id");
		$question->total_answer+=1;
		$question->save();

		$answer = new Answer();		
		$answer->content = $request->get('content');
		$answer->user()->associate(Auth::user());
		$answer->question()->associate($question);
		$answer->total_like = 0;
		$answer->total_dislike = 0;
		$answer->attachment_path = null;
		$answer->save();	
		
		if($request->hasFile('attachment')) {
			$filename = $answer->_id.'.'.$request->attachment->getClientOriginalExtension();
			$answer->attachment_path = $filename;
			$request->attachment->move('files/', $filename);
		}
		$answer->save();
		

		(new UserController)->createNotification($question->user, Notification::$target['question'], Notification::$action['answer'],  $question->_id);

		return redirect()->route('viewTopic', ['id' => $answer->question_id]);
	}

	public function edit($id)
	{
	
		$answer = Auth::user()->answers()->find($id);
		if(empty($answer)) {
			return redirect()->back();
		} 
		$question = $answer->question;
		$parsedown = new \Parsedown();
		$question->content = $parsedown->setMarkupEscaped(true)->text($question->content);

		return view('answer.edit_answer',compact('answer','id','question'));
	}

	public function update(AnswerRequest $request)
	{

		$answer = Answer::find($request->get('id'));
		$answer->content = $request->get('content');
		if($request->hasFile('attachment')) {
			File::delete('files/'.$answer->attachment_path);
			$filename = $answer->_id.'.'.$request->attachment->getClientOriginalExtension();
			$answer->attachment_path = $filename;
			$request->attachment->move('files/', $filename);
		}
		$answer->save();

		return redirect()->route('viewTopic', ['id' => $answer->question_id]);
	}
}
