<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\User_Question_Answer;
use App\Notification;
use App\user;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class ViewTopicController extends Controller
{
    public function view($id)
    {
        $question = Question::find($id);
        if(empty($question))
        {
            return redirect()->route('homePage');
        } 
        else 
        {
            $answers = $question->answers()->get();
            $best_answer=null;
            $question->total_answer = $answers->count();
            $question->save(); 
            $parsedown = new \Parsedown();
            $question->content = $parsedown->setMarkupEscaped(true)->text($question->content);

            $now = Carbon::now();
            $question->date_convert = $question->created_at->diffForHumans($now);
            foreach ($answers as $answer) 
            {
                $answer->content = $parsedown->setMarkupEscaped(true)->text($answer->content);
                $answer->date_convert = $answer->created_at->diffForHumans($now);
            }
            if(!empty($question->best_answer_id)) 
            {
                $best_answer= Answer::find($question->best_answer_id);
                $best_answer->content = $parsedown->setMarkupEscaped(true)->text($best_answer->content);
                $best_answer->date_convert = $best_answer->created_at->diffForHumans($now);
            }

            return view('view_topic',compact('question','answers','best_answer'));
        } 
    }

    public function bestAnswer($id_answer)
    {
    	$answer = Answer::find($id_answer);
        $question = Question::find($answer->question_id);
        $question->best_answer_id = $id_answer;
        $question->save();

        (new UserController)->createNotification($answer->user_id, Notification::$target[1], Notification::$action[3],  $question->_id);

        return redirect()->route('viewTopic',compact('question'));
    }

    public function removeBestAnswer($id_answer)
    {
        $answer = Answer::find($id_answer);
        $question = Question::find($answer->question_id);
        $question->best_answer_id = null;
        $question->save();

        return redirect()->route('viewTopic',compact('question'));        
    }
    
    public function checkLike($post_id,$post_type,$user_id)
    {
        $user_liked=User_Question_Answer::where('user_id',$user_id)->where('post_id', $post_id)->where('action', "Like")->where('post_type',$post_type)->get();

        return $user_liked;
    }

    public function checkDislike($post_id,$post_type,$user_id)
    {
        $user_disliked=User_Question_Answer::where('user_id',$user_id)->where('post_id', $post_id)->where('action', "Dislike")->where('post_type',$post_type)->get();

        return $user_disliked;
    }

    public function like($post_id,$post_type,$user_id)
    {
        $user_liked    =$this->checkLike($post_id,$post_type,$user_id);
        $user_disliked =$this->checkDislike($post_id,$post_type,$user_id);
        
        if ($user_liked->count()==0){
            if ($post_type =='Question')
            {
                $question= Question::find($post_id);    
                $question->total_like += 1;
                $question->save();

                (new UserController)->createNotification($question->user_id, Notification::$target[0], Notification::$action[1],  $question->_id);
                
            }
            else
            {
                $answer= Answer::find($post_id);  
                $answer->total_like += 1;
                $answer->save();
                
                (new UserController)->createNotification($answer->user_id, Notification::$target[1], Notification::$action[1],  $answer->question_id);
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
        
        return redirect()->back();
        
    }

		      
    public function dislike($post_id,$post_type,$user_id)
    {
        $user_liked=$this->checkLike($post_id,$post_type,$user_id);
        $user_disliked=$this->checkDislike($post_id,$post_type,$user_id);
        if ($user_disliked->count()==0)
        {
            if ($post_type =='Question')
            {
                $question= Question::find($post_id);          
                $question->total_dislike += 1;
                $question->save();
                (new UserController)->createNotification($question->user_id, Notification::$target[0], Notification::$action[2],  $question->_id);
            }
            else
            {
                $answer= Answer::find($post_id);            
                $answer->total_dislike += 1;
                $answer->save();
                (new UserController)->createNotification($answer->user_id, Notification::$target[1], Notification::$action[2],  $answer->question_id);
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
       
        return redirect()->back();        
    }
}

