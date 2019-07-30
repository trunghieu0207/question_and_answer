<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class User_Question_Answer extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'antman_user_question_answer';
}
