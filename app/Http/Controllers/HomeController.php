<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index()
	{
		$questions = Question::all();
		return view('home',['questions' => $questions]);
	}
}