<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Answer extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'antman_answers';
    
    protected $fillable = [
        'content','user_id','question_id',
    ];

    public function user() {
    	return $this->belongsTo('App\User', 'user_id', '_id');
    }
    
    public function question() {
    	
    	return $this->belongsTo('App\Question', 'question_id', '_id');
    }

    public function user_question_answers() {

    	return $this->hasMany('App\User_Question_Answer', 'post_id', '_id');
    }
}