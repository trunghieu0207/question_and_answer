<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Http\Request;
use App\Category;
use App\Attachment;
use Illuminate\Support\Facades\Auth;


class QuestionController extends Controller
{
	public function create()
	{
		if(Auth::check()){
			$categories = Category::all();
			return view('addtopic',compact('categories'));
		} else {
			return view('signin');
		}
	}

	public function store(Request $request)
	{
		$question = new Question();
		$question->title = $request->get('title');
		$question->content = $request->get('content');
		$question->user_id = session('id');
		$question->category_id = $request->get('category');
		$question->total_like = 0;
		$question->total_dislike = 0;
		$question->total_answer = 0;
		$question->save();
		return redirect('/');
	}

	  /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	  public function fileUpload()
	  {
	  	return view('addtopic');
	  }

	  public function fileUploadPost(Request $request, $id)
	  {
	  	$request->validate([
	  		'file' => 'required',
	  	]);

	  	$fileName = time().'.'.request()->file->getClientOriginalExtension();
	  	request()->file->move(storage_path('app'), $fileName);

	  	return response()->json(['success'=>'You have successfully upload file.']);

	  }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


}
