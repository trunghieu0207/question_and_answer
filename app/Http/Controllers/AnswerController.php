<?php

namespace App\Http\Controllers;
use App\Answer;
use Illuminate\Http\Request;
use App\Question;
use App\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use File;

class AnswerController extends Controller
{

	public function store(Request $request)
	{
		// $validatedData = $request->validate([
		// 	'title' => 'required|max:255',
		// 	'content' => 'required',
		// ]);

		$answer = new Answer();
		$answer->content = $request->get('content');
		$answer->user_id = Auth::user()->_id;
		$answer->question_id = $request->get('question_id');
		$id_question = $answer->question_id;
		$question = Question::find($id_question);
		$question->total_answer+=1;
		$question->save();
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

		(new UserController)->createNotification($question->user_id, Notification::$target[0], Notification::$action[0],  $question->_id);

		return redirect()->route('viewTopic', ['id' => $answer->question_id]);
	}

	public function edit($id)
	{
		$limit = \Config::get('constants.options.limitCharacterAttachmentName');
		$answer = Answer::find($id);
		if(empty($answer)) {
			return redirect()->route('homePage');
		} 
		$question = $answer->question;
		$parsedown = new \Parsedown();
		$question->content = $parsedown->setMarkupEscaped(true)->text($question->content);
		$question->date_convert = $question->created_at->diffForHumans();

		return view('answer.edit_answer',compact('answer','id','question','limit'));
	}

	public function update(Request $request)
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
