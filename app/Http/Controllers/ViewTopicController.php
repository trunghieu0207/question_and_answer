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
        $best_answer=null;
        
        $parsedown = new \Parsedown();
        $question->content = $parsedown->text($question->content);
        foreach ($answers as $answer) {
            $answer->content = $parsedown->text($answer->content);
        }
        if(!empty($question->best_answer_id)) {
            $best_answer= Answer::find($question->best_answer_id);
            $best_answer->content = $parsedown->text($best_answer->content);
        }
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
    
    public function checkLike($user_id)
    {
        $user_liked=User_Question_Answer::where('user_id','like',$user_id)->where('post_id', 'like', $post_id)->where('action', 'like', "Like")->get();
        if ($user_liked->count()==0) return False;
        else return True;
    }

    public function like($post_id,$post_type,$user_id)
    {

    	$user_liked=User_Question_Answer::where('user_id','like',$user_id)->where('post_id', 'like', $post_id)->where('action', 'like', "Like")->get();
        $user_disliked=User_Question_Answer::where('user_id','like',$user_id)->where('post_id', 'like', $post_id)->where('action', 'like',"Dislike" )->get();
        if ($user_liked->count()==0){
            if ($post_type =='Question')
            {
                $question= Question::find($post_id);    
                $question->total_like += 1;
                $question->save();
            }
            else
            {
                $answer= Answer::find($post_id);
                $question=$answer->question_id;        
                $answer->total_like += 1;
                $answer->save();
            }
            $like=new User_Question_Answer();
            $like->user_id=$user_id;
            $like->post_id=$post_id;
            $like->post_type=$post_type;
            $like->action="Like";
            $like->save();
            if ($user_disliked->count()!=0)
            {   
                if ($post_type =='Question')
                {         
                    $question->total_dislike -= 1;
                    $question->save();
                }
                else
                {            
                    $answer->total_dislike -= 1;
                    $answer->save();
                }
                foreach($user_disliked as $undislike){                
                    $undislike->delete();
                }
            }
        }
        else
        {
            if ($post_type =='Question')
            {
                $question= Question::find($post_id);    
                $question->total_like -= 1;
                $question->save();
            }
            else
            {   
                $answer= Answer::find($post_id);
                $question=$answer->question_id;        
                $answer->total_like -= 1;
                $answer->save();
            }
            foreach($user_liked as $unlike){                
                $unlike->delete();
            }

        }
        
        return redirect()->route('view-topic',compact('question'));
    }

		      
    public function dislike($post_id,$post_type,$user_id)
    {
        $user_liked=User_Question_Answer::where('user_id','like',$user_id)->where('post_id', 'like', $post_id)->where('action', 'like', "Like")->get();
        $user_disliked=User_Question_Answer::where('user_id','like',$user_id)->where('post_id', 'like', $post_id)->where('action', 'like',"Dislike" )->get();
        if ($user_disliked->count()==0)
        {
            if ($post_type =='Question')
            {
                $question= Question::find($post_id);          
                $question->total_dislike += 1;
                $question->save();
            }
            else
            {
                $answer= Answer::find($post_id);
                $question=$answer->question_id;               
                $answer->total_dislike += 1;
                $answer->save();
            }
            $dislike=new User_Question_Answer();
            $dislike->user_id=$user_id;
            $dislike->post_id=$post_id;
            $dislike->post_type=$post_type;
            $dislike->action="Dislike";
            $dislike->save();
            if ($user_liked->count()!=0)
            {   
                if ($post_type =='Question')
                {         
                    $question->total_like -= 1;
                    $question->save();
                }
                else
                {            
                    $answer->total_like -= 1;
                    $answer->save();
                }
                foreach($user_liked as $unlike){                
                    $unlike->delete();
                }
            }
        }
        else
        {
            if ($post_type =='Question')
            {
                $question= Question::find($post_id);          
                $question->total_dislike -= 1;
                $question->save();
            }
            else
            {
                $answer= Answer::find($post_id);
                $question=$answer->question_id;               
                $answer->total_dislike -= 1;
                $answer->save();
            }
            foreach($user_disliked as $undislike){                
                $undislike->delete();
            }
        }
       
        return redirect()->route('view-topic',compact('question'));        
    }
}

