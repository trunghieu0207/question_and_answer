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
            return redirect()->back();
        } 
        else 
        {
            $answers = Answer::where('question_id',$id)->orderBy('total_like','desc')->paginate(5);
            $best_answer=null;
            $question->total_answer = $answers->count();
            $question->save(); 
            $parsedown = new \Parsedown();
            $question->content = $parsedown->setMarkupEscaped(true)->text($question->content);
            $question->date_convert = $question->created_at->diffForHumans();
            foreach ($answers as $answer) 
            {
                $answer->content = $parsedown->setMarkupEscaped(true)->text($answer->content);
                $answer->date_convert = $answer->created_at->diffForHumans();
            }
            if(!empty($question->best_answer_id)) 
            {
                $best_answer= Answer::find($question->best_answer_id);
                $best_answer->content = $parsedown->setMarkupEscaped(true)->text($best_answer->content);
                $best_answer->date_convert = $best_answer->created_at->diffForHumans();
            }
            $limitCharacter = \Config::get('constants.options.limitCharacterAttachmentName');
            return view('view_topic',compact('question','answers','best_answer','limitCharacter'));
        } 
    }

    public function bestAnswer($id_answer)
    {
    	$answer = Answer::find($id_answer);
        $question = Question::find($answer->question_id);
        $question->best_answer_id = $id_answer;
        $question->save();

        (new UserController)->createNotification($answer->user_id, Notification::$target[1], Notification::$action[3],  $question->_id);

        return redirect()->back();
    }

    public function removeBestAnswer($id_answer)
    {
        $answer = Answer::find($id_answer);
        $question = Question::find($answer->question_id);
        $question->best_answer_id = null;
        $question->save();

        return redirect()->back();        
    }
    
    public function checkLike($post_id,$post_type,$user_id)
    {
        $user_liked=User_Question_Answer::where('user_id',$user_id)->where('post_id', $post_id)->where('action', "Like")->where('post_type',$post_type)->first();

        return $user_liked;
    }

    public function checkDislike($post_id,$post_type,$user_id)
    {
        $user_disliked=User_Question_Answer::where('user_id',$user_id)->where('post_id', $post_id)->where('action', "Dislike")->where('post_type',$post_type)->first();

        return $user_disliked;
    }

    public function like($post_id,$post_type,$user_id)
    {
        $user_liked    =$this->checkLike($post_id,$post_type,$user_id);
        $user_disliked =$this->checkDislike($post_id,$post_type,$user_id);
        
        if (!$user_liked){
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
            $this->addUserQuestionAnswer($post_id,$post_type,$user_id,"Like");            
            if ($user_disliked)
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
                $user_disliked->delete();
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
                $answer->total_like -= 1;
                $answer->save();
            }                
            $user_liked->delete();
        }

        return redirect()->back();  
    }
    public function dislike($post_id,$post_type,$user_id)
    {
        $user_liked=$this->checkLike($post_id,$post_type,$user_id);
        $user_disliked=$this->checkDislike($post_id,$post_type,$user_id);
        if (!$user_disliked)
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
            $this->addUserQuestionAnswer($post_id,$post_type,$user_id,"Dislike");
            if ($user_liked)
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
                $user_liked->delete();
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
                $answer->total_dislike -= 1;
                $answer->save();
            }

            $user_disliked->delete();
        }
       
        return redirect()->back();        
    }

    public function addUserQuestionAnswer($post_id,$post_type,$user_id,$action)
    {
        $post=new User_Question_Answer();
        $post->user_id=$user_id;
        $post->post_id=$post_id;
        $post->post_type=$post_type;
        $post->action=$action;
        $post->save();
    }

}




