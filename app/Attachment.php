<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Attachment extends Eloquent
{
	protected $connection = 'mongodb';
	protected $collection = 'attachments';

	protected $fillable = [
		'name','type','path','postable_id','postable_type'
	];
}
