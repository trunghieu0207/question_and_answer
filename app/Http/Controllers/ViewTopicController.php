<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\LikeDislike;
use App\Notification;
use App\user;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ViewTopicController extends Controller
{

    public function view($id)
    {
        $question = Question::find($id);
        if(empty($question))
        {
            return redirect()->back();
        }         
        $limit=\Config::get('constants.options.ItemNumberPerPage');
        $answers = Answer::where('question_id',$id)->orderBy('total_like','desc')->paginate($limit);
        $bestAnswer=null;
        $parsedown = new \Parsedown();
        $question->content = $parsedown->setMarkupEscaped(true)->text($question->content);
        
        foreach ($answers as $answer) 
        {
            $answer->content = $parsedown->text($answer->content);
        }
        if(!empty($question->bestAnswer)) 
        {
            $bestAnswer= $question->bestAnswer;
            $bestAnswer->content = $parsedown->setMarkupEscaped(true)->text($bestAnswer->content);
        }
        
        
        return view('question.view_topic',compact('question','answers','bestAnswer'));
    
    }

    public function bestAnswer($id_answer)
    {
        $question = Answer::find($id_answer)->question;
        $question->best_answer_id = $id_answer;
        $question->save();

        (new UserController)->createNotification($answer->user, Notification::$target['answer'], Notification::$action['accept'],  $question->_id);

        return redirect()->back();
    }

    public function removeBestAnswer($id_answer)
    {
        
        $question = Answer::find($id_answer)->question;
        $question->best_answer_id = null;
        $question->save();

        return redirect()->back();        
    }
    
    public function checkLike($post_id,$post_type,$user_id)
    {
        $user_liked=LikeDislike::where('user_id',$user_id)->where('post_id', $post_id)->where('action', "Like")->where('post_type',$post_type)->first();

        return $user_liked;
    }

    public function checkDislike($post_id,$post_type,$user_id)
    {
        $user_disliked=LikeDislike::where('user_id',$user_id)->where('post_id', $post_id)->where('action', "Dislike")->where('post_type',$post_type)->first();

        return $user_disliked;
    }

    public function like($post_id,$post_type)
    {
        $user_liked    =$this->checkLike($post_id,$post_type,Auth::user()->id);
        $user_disliked =$this->checkDislike($post_id,$post_type,Auth::user()->id);
        
        if (!$user_liked){

            if ($post_type =='Question')
            {
                $question= Question::find($post_id);    
                $question->total_like += 1;
                $question->save();
                (new UserController)->createNotification($question->user, Notification::$target['question'], Notification::$action['like'],  $question->_id);
                
            }
            else
            {
                $answer= Answer::find($post_id);       
                $answer->total_like += 1;
                $answer->save();
                (new UserController)->createNotification($answer->user, Notification::$target['answer'], Notification::$action['like'],  $answer->question_id);            
            }            
            $this->addLikeDislike($post_id,$post_type,Auth::user(),"Like");            
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

    public function dislike($post_id,$post_type)
    {
        $user_liked=$this->checkLike($post_id,$post_type,Auth::user()->id);
        $user_disliked=$this->checkDislike($post_id,$post_type,Auth::user()->id);
        if (!$user_disliked)
        {
            if ($post_type =='Question')
            {
                $question= Question::find($post_id);          
                $question->total_dislike += 1;
                $question->save();
                (new UserController)->createNotification($question->user, Notification::$target['question'], Notification::$action['dislike'],  $question->_id);
            }
            else
            {
                $answer= Answer::find($post_id);              
                $answer->total_dislike += 1;
                $answer->save();
                (new UserController)->createNotification($answer->user, Notification::$target['answer'], Notification::$action['dislike'],  $answer->question_id);
            }
            $this->addLikeDislike($post_id,$post_type,Auth::user(),"Dislike"); 
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

    public function addLikeDislike($post_id,$post_type,$user,$action)
    {
        $likeDislike=new LikeDislike();
        $likeDislike->user()->associate($user);
        $likeDislike->post_id=$post_id;
        $likeDislike->post_type=$post_type;
        $likeDislike->action=$action;
        $likeDislike->save();
    }

}




