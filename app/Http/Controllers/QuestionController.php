<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Http\Request;
use App\Category;
use App\Answer;
use Illuminate\Support\Facades\Auth;
use File;
use App\Http\Requests\AddTopicRequest;
use Illuminate\Support\Facades\Storage;
class QuestionController extends Controller
{
	private $typeFiles = array('application/x-rar-compressed', 'application/octet-stream', 'application/zip', 'application/x-rar', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');

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
			$typeFiles = $this->typeFiles;
			$typeFileAttachment = $request->attachment->getMimeType();
			if(in_array($typeFileAttachment, $typeFiles)) {
				$filename = $question->_id.'.'.$request->attachment->getClientOriginalExtension();
				$question->attachment_path = $filename;
				Storage::putFileAs('public/files/', $request->attachment, $filename);
				$question->save();
			} else {
				session()->flash('errorUpload', 'Files only support ZIP and RAR formats');
					
				return redirect()->back();
			}
		}
		$id = $question->_id;

		return redirect()->route('viewTopic', ['id' => $id]);
	}

	public function edit($id)
	{

		$categories = Category::all();
		$question = Question::find($id);
		$limit = \Config::get('constants.options.limitCharacterAttachmentName');
		if(empty($question)){

			return redirect()->route('homePage');
		} 

		return view('question.edit_topic',compact('question','id','categories','limit'));
	}
	
	public function update(AddTopicRequest $request)
	{

		$question = Question::find($request->get('id'));
		$question->title = $request->get('title');
		$question->content = $request->get('content');
		$question->category_id = $request->get('category');
		
		if($request->hasFile('attachment')) {
			Storage::delete('public/files/'.$question->attachment_path);
			$typeFiles = $this->typeFiles;
			$typeFileAttachment = $request->attachment->getMimeType();
			if(in_array($typeFileAttachment, $typeFiles)) {

				$filename = $question->_id.'.'.$request->attachment->getClientOriginalExtension();
				$question->attachment_path = $filename;
				Storage::putFileAs('public/files/', $request->attachment, $filename);
			} else {
				session()->flash('errorUpload', 'Files only support ZIP and RAR formats');
					
				return redirect()->back();
			}
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