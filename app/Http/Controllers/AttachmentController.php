<?php

namespace App\Http\Controllers;
use App\Attachment;
use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use Illuminate\Support\Facades\Auth;

class AttachmentController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUpload()
    {
    	return view('addtopic');
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUploadPost(Request $request)
    {
        $request->validate([
            'file' => 'required',
		]);
 
        $fileName = request()->file->getClientOriginalName();
        request()->file->move(public_path('files'), $fileName);
        return response()->json(['success'=>'You have successfully upload file.']);
    }
}
