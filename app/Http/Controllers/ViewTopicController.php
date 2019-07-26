<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;

class ViewTopicController extends Controller
{
    public function view($id){
        $question = Question::find($id);
        $answers = Answer::where('question_id','like',$id)->get();
        //$question->first();
        return view('viewtopic',compact('question','answers'));
    }
}
