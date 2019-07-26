<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\User_Question_Answer;

class ViewTopicController extends Controller
{
    public function view($id)
    {
        $question = Question::find($id);
        $answers = Answer::where('question_id','like',$id)->get();
        $best_answer= Answer::find($question->best_answer_id);
        return view('viewtopic',compact('question','answers','best_answer'));
    }
    public function bestAnswer($id_answer)
    {
    	$answer = Answer::find($id_answer);
    	$id_question=$answer->question_id;
        $question = Question::find($id_question);
        $question->best_answer_id = $id_answer;
        $question->save();
        return redirect()->route('view-topic',compact('question'));
        
    }
    public function like($post_id,$post_type,$user_id)
    {
    	if ($post_type =='Question')
    	{
    		$question= Question::find($post_id);
    		
    		$question->total_like += 1;
    		$question->save();
    	}
    	$like=new User_Question_Answer();
		$like->user_id=$user_id;
		$like->post_id=$post_id;
		$like->post_type=$post_type;
		$like->action="Like";
		// $like->created_at= date('d/m/Y - H:i:s');
		$like->save();
		return redirect()->route('view-topic',compact('question'));

        
    }

}
