<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Question extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'questions';
    protected $fillable = [
        'title','content','user_id','best_answer','category_id'
    ];

    public function categories()
    {
    	return $this->belongsTo('App\Category','category_id','_id');
    }

    public function user() {
    	return $this->belongsTo('App\User', 'user_id', '_id');
    }
   
}

