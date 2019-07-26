<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\Auth;


class QuestionController extends Controller
{
	public function create()
	{
		if(Auth::check()){
			return view('addtopic');
		} else {
			return view('signin');
		}
	}


}
