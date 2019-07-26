<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;

class ViewTopicController extends Controller
{
    public function view(){
        $question = Question::first();
        $answer = Answer::first();
        //$question->first();
        return view('viewtopic',compact('question'),compact('answer'));
    }
}
