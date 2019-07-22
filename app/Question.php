<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Question extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'Questions';
    
    protected $fillable = [
        'title','content','user_id','best_answer','category_id'
    ];
}