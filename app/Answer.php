<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Answer extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'Answers';
    
    protected $fillable = [
        'content','user_id','question_id',
    ];
}