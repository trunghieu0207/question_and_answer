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
    public function bestAnswer($id_answer){
    	$answer = Answer::find($id_answer);
    	$id_question=$answer->question_id;
        $question = Question::find($id_question);
        $question->best_answer_id = $id_answer;
        $question->save();
        return redirect()->route('view-topic',compact('question','answer'));
        
    }
}
