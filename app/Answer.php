<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Answer extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'answers';
    
    protected $fillable = [
        'content','user_id','question_id',
    ];
    public function user() {
    	return $this->belongsTo('App\User', 'user_id', '_id');
    }
}