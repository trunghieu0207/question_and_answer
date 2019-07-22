<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Question extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'questions';

     protected $fillable = [
        'title', 'content','best_answer'
    ];

    public function categories()
    {
    	return $this->belongsTo('App\Category','category_id','_id');
    }

}
