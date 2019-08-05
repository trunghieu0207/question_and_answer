<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Http\Request;
use App\Category;
use App\Answer;
use Illuminate\Support\Facades\Auth;
use File;
use App\Http\Requests\AddTopicRequest;

class QuestionController extends Controller
{
	public function create()
	{
		$categories = Category::all();

		return view('question.add_topic',compact('categories'));
	}

	public function store(AddTopicRequest $request)
	{


		$question = new Question();
		$question->title = $request->get('title');
		$question->content = $request->get('content');
		$question->user_id = Auth::user()->_id;
		$question->category_id = $request->get('category');
		$question->total_like = 0;
		$question->total_dislike = 0;
		$question->total_answer = 0;
		$question->attachment_path = null;
		$question->save();
		if($request->hasFile('attachment')) {
			$filename = $question->_id.'.'.$request->attachment->getClientOriginalExtension();
			$question->attachment_path = $filename;
			$request->attachment->move('files/', $filename);
		}
		$question->save();

		return redirect('/');
	}

	public function edit($id)
	{

		$categories = Category::all();
		$question = Question::find($id);
		if(empty($question)){

			return redirect()->route('homePage');
		} 

		return view('question.edit_topic',compact('question','id','categories'));
	}
	
	public function update(AddTopicRequest $request)
	{

		$question = Question::find($request->get('id'));
		$question->title = $request->get('title');
		$question->content = $request->get('content');
		$question->category_id = $request->get('category');
		if($request->hasFile('attachment')) {
			File::delete('files/'.$question->attachment_path);
			$filename = $question->_id.'.'.$request->attachment->getClientOriginalExtension();
			$question->attachment_path = $filename;
			$request->attachment->move('files/', $filename);
		}
		$question->save();

		return redirect()->route('viewTopic', ['id' => $request->get('id')]);
	}

	public function destroy(Request $request)
	{
		$this->removeQuestion($request);
		
		return redirect()->route('homePage');
	}
	
	public function removeQuestion(Request $request)
	{
		$question = Question::where('user_id', '=', Auth::user()->id)->where('_id', '=', $request->_id)->first();
		
		if(empty($question)) return 'Question not found';

		$question->delete();
	}
}